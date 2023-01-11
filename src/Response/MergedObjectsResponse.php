<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Response;

use Generator;
use LogicException;
use Nette\Utils\Arrays;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Traversable;
use WebChemistry\Fmp\Result\FmpResult;

/**
 * @template T of FmpResult
 * @implements ChildrenResponse<T>
 */
final class MergedObjectsResponse implements ChildrenResponse
{

	/** @use SymbolObjectsResponse<T> */
	use SymbolObjectsResponse;

	/**
	 * @param class-string<T> $className
	 * @param ChildrenResponse<T>[] $responses
	 */
	public function __construct(
		private string $className,
		private array $responses,
	)
	{
	}

	/**
	 * @return class-string<T>
	 */
	public function getClassName(): string
	{
		return $this->className;
	}

	/**
	 * @return ChildrenResponse<T>[]
	 */
	public function getResponses(): array
	{
		return $this->responses;
	}

	/**
	 * @return T[]
	 */
	public function toObjects(bool $throw = true): array
	{
		return Response::toArrayIgnoreKeys($this->yieldObjects($throw));
	}

	/**
	 * @return Generator<T>
	 * @throws ClientExceptionInterface
	 * @throws DecodingExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 */
	public function yieldObjects(bool $throw = true): Generator
	{
		foreach ($this->responses as $response) {
			yield from $response->yieldObjects($throw);
		}
	}

	public function hasSymbol(string $symbol): bool
	{
		return Arrays::some(
			$this->responses,
			fn (ChildrenResponse $response): bool => $response->hasSymbol($symbol),
		);
	}

	/**
	 * @return Traversable<T>&Generator<T>
	 */
	public function getIterator(): Traversable
	{
		return $this->yieldObjects();
	}

	public function count(bool $throw = true): int
	{
		return count($this->toObjects($throw));
	}

	public function getStatusCode(): int
	{
		$this->unsupported();
	}

	public function getHeaders(bool $throw = true): array
	{
		$this->unsupported();
	}

	public function getContent(bool $throw = true): string
	{
		$this->unsupported();
	}

	/**
	 * @return mixed[]
	 */
	public function toArray(bool $throw = true): array
	{
		$result = [];

		foreach ($this->responses as $response) {
			$result = array_merge($result, $response->toArray($throw));
		}

		return $result;
	}

	public function cancel(): void
	{
		foreach ($this->responses as $response) {
			$response->cancel();
		}
	}

	public function getInfo(string $type = null): mixed
	{
		$this->unsupported();
	}

	private function unsupported(): never
	{
		throw new LogicException('Cannot get info from coupled response.');
	}

}
