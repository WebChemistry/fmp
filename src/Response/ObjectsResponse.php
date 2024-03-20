<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Response;

use DomainException;
use Generator;
use OutOfBoundsException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Traversable;
use WebChemistry\Fmp\Request\RequestArguments;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Result\SymbolResult;
use WebChemistry\Fmp\Serializer\HttpDecoder;

/**
 * @template T of FmpResult
 * @implements ChildrenResponse<T>
 */
class ObjectsResponse extends Response implements ChildrenResponse
{

	/** @use SymbolObjectsResponse<T> */
	use SymbolObjectsResponse;

	/** @var array<string, T> */
	private array $indexed;

	/** @var T[] */
	private array $objects;

	/** @var (callable(mixed[]): mixed[])|null */
	private $getter;

	/**
	 * @param class-string<T> $className
	 * @param (callable(mixed[]): mixed[])|null $getter
	 * @param mixed[] $options
	 */
	public function __construct(
		private readonly string $className,
		HttpDecoder $decoder,
		ResponseInterface $response,
		?callable $getter = null,
		array $options = [],
	)
	{
		parent::__construct($decoder, $response, $options);

		$this->getter = $getter;
	}

	/**
	 * @return class-string<T>
	 */
	public function getClassName(): string
	{
		return $this->className;
	}

	public function count(bool $throw = true): int
	{
		return count($this->toArray($throw));
	}

	/**
	 * @return T[]
	 */
	public function toObjects(bool $throw = true): array
	{
		return $this->objects ??= $this->toArrayIgnoreKeys($this->yieldObjects($throw));
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
		if (isset($this->objects)) {
			return $this->objects;
		}

		$array = $this->toArray($throw);

		if ($this->getter) {
			$array = ($this->getter)($array);
		}

		foreach ($array as $object) {
			yield new ($this->className)($object, $this->options);
		}
	}

	public function hasSymbol(string $symbol): bool
	{
		return isset($this->getIndexed()[$this->normalizeSymbol($symbol)]);
	}

	/**
	 * @return T
	 */
	public function getSymbol(string $symbol): FmpResult
	{
		return $this->getIndexed()[$this->normalizeSymbol($symbol)] ?? throw new OutOfBoundsException(sprintf('Symbol "%s" not found.', $symbol));
	}

	/**
	 * @return array<string, T>
	 */
	private function getIndexed(): array
	{
		if (!isset($this->indexed)) {
			$this->indexed = [];

			foreach ($this->toObjects() as $object) {
				if (!$object instanceof SymbolResult) {
					throw new DomainException(
						sprintf(
							'Indexed array can be used only with result implements %s interface.',
							SymbolResult::class
						)
					);
				}

				$this->indexed[$this->normalizeSymbol($object->getSymbol())] = $object;
			}
		}

		return $this->indexed;
	}

	/**
	 * @return Traversable<T>&Generator<T>
	 */
	public function getIterator(): Traversable
	{
		return $this->yieldObjects();
	}

	private function normalizeSymbol(string $symbol): string
	{
		return strtolower($symbol);
	}

}

