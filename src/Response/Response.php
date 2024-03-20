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
		private readonly ResponseInterface $response,
		array $options = [],
	)
	{
		$this->metadata = $options['metadata'] ?? [];
		unset($options['metadata']);
		$this->options = $options;
	}

	/**
	 * @inheritDoc
	 */
	public function getStatusCode(): int
	{
		return $this->response->getStatusCode();
	}

	/**
	 * @inheritDoc
	 */
	public function getHeaders(bool $throw = true): array
	{
		return $this->response->getHeaders($throw);
	}

	/**
	 * @inheritDoc
	 */
	public function getContent(bool $throw = true): string
	{
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
					throw new EmptyResponseException('Response is empty.');
				}

				$result = $result[0];
			}

			if (isset($this->metadata['callback']) && is_callable($this->metadata['callback'])) {
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

}

