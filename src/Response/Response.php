<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Response;

use Nette\Utils\Arrays;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Traversable;
use Typertion\Php\TypeAssert;
use WebChemistry\Fmp\Exception\DecodingException;
use WebChemistry\Fmp\Exception\EmptyResponseException;
use WebChemistry\Fmp\Exception\InvalidFmpRequestException;
use WebChemistry\Fmp\Request\RequestArguments;
use WebChemistry\Fmp\Serializer\HttpDecoder;

abstract class Response implements ResponseInterface
{

	private ResponseInterface $response;

	private int $repeat = 0;

	/** @var callable(ResponseInterface): bool */
	private $validator;

	/** @var mixed[] */
	private array $arrayData;

	/** @var mixed[] */
	private array $metadata;

	/** @var mixed[] */
	protected readonly array $options;

	/**
	 * @param mixed[] $options
	 */
	public function __construct(
		private readonly HttpDecoder $decoder,
		private readonly RequestArguments $arguments,
		array $options = [],
	)
	{
		$this->metadata = $options['metadata'] ?? [];
		unset($options['metadata']);
		$this->options = $options;

		$this->retryRequest();
	}

	/**
	 * @param callable(ResponseInterface): bool $validator
	 */
	public function repeatable(int $times, callable $validator): self
	{
		$this->repeat = $times;
		$this->validator = $validator;

		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getStatusCode(): int
	{
		$this->check();

		return $this->response->getStatusCode();
	}

	/**
	 * @inheritDoc
	 */
	public function getHeaders(bool $throw = true): array
	{
		$this->check();

		return $this->response->getHeaders($throw);
	}

	/**
	 * @inheritDoc
	 */
	public function getContent(bool $throw = true): string
	{
		$this->check();

		return $this->response->getContent($throw);
	}

	/**
	 * @inheritDoc
	 * @return mixed[]
	 */
	public function toArray(bool $throw = true, bool $cache = false): array
	{
		if (isset($this->arrayData)) {
			return $this->arrayData;
		}

		$this->check();

		if (($content = $this->getContent($throw)) === '') {
			throw new DecodingException('Response body is empty.');
		}

		$headers = $this->getHeaders($throw);

		try {
			$result = $this->decoder->decode($content, Arrays::first($headers['content-type'] ?? []));

			if (!is_array($result)) {
				throw new DecodingException(
					sprintf(
						'Content was expected to decode to an array, "%s" returned for "%s".',
						get_debug_type($result),
						TypeAssert::stringOrNull($this->getInfo('url')),
					)
				);
			}

			if (($this->metadata['itemAsArray'] ?? false)) {
				if (!isset($result[0])) {
					throw new EmptyResponseException(
						sprintf('Response is empty for "%s".', $this->getSafeLink()),
					);
				}

				$result = $result[0];
			}

			if (isset($this->metadata['callback'])) {
				$result = ($this->metadata['callback'])($result);
			}

			if ($cache) {
				$this->arrayData = $result;
			}

			return $result;
		} catch (UnexpectedValueException $exception) {
			throw new DecodingException($exception->getMessage(), 0, $exception);
		}
	}

	private function getSafeLink(): string
	{
		if (!isset($this->metadata['safeLink'])) {
			return '';
		}

		return $this->metadata['safeLink']();
	}

	/**
	 * @inheritDoc
	 */
	public function cancel(): void
	{
		$this->response->cancel();
	}

	/**
	 * @inheritDoc
	 */
	public function getInfo(?string $type = null): mixed
	{
		$this->check();

		return $this->response->getInfo($type);
	}

	/**
	 * @template TValue
	 * @param iterable<mixed, TValue> $items
	 * @return TValue[]
	 */
	public static function toArrayIgnoreKeys(iterable $items): array
	{
		if ($items instanceof Traversable) {
			return iterator_to_array($items, false);
		}

		$array = [];

		foreach ($items as $item) {
			$array[] = $item;
		}

		return $array;
	}

	private function retryRequest(): void
	{
		$this->response = $this->arguments->client->request($this->arguments->method, $this->arguments->url);
	}

	private function check(): void
	{
		for (; $this->repeat > 0; $this->repeat--) {
			if (($this->validator)($this->response)) {
				$this->retryRequest();
			}
		}

		$this->checkErrorMessages();
	}

	private function checkErrorMessages(): void
	{
		if ($this->response->getStatusCode() !== 200) {
			return;
		}

		$headers = $this->response->getHeaders(false);

		if (!isset($headers['content-type']) || !isset($headers['content-length'])) {
			return;
		}

		$contentType = implode(',', $headers['content-type']);
		$contentLength = (int) (Arrays::first($headers['content-length']) ?? PHP_INT_MAX);

		if (str_contains($contentType, 'application/json') && $contentLength < 700) {
			$json = $this->response->toArray(false);

			if (isset($json['Error Message'])) {
				throw new InvalidFmpRequestException($json['Error Message']);
			}
		}
	}

}

