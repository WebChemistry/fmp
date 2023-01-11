<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Response;

use Countable;
use Generator;
use IteratorAggregate;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Traversable;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Utility\ArrayIndex;

/**
 * @template T of FmpResult
 * @extends IteratorAggregate<T>
 */
interface ChildrenResponse extends Countable, IteratorAggregate, ResponseInterface
{

	/**
	 * @return class-string<T>
	 */
	public function getClassName(): string;

	/**
	 * @return T[]
	 */
	public function toObjects(bool $throw = true): array;

	/**
	 * @return Generator<T>
	 * @throws ClientExceptionInterface
	 * @throws DecodingExceptionInterface
	 * @throws RedirectionExceptionInterface
	 * @throws ServerExceptionInterface
	 * @throws TransportExceptionInterface
	 */
	public function yieldObjects(bool $throw = true): Generator;

	public function hasSymbol(string $symbol): bool;

	/**
	 * @return ArrayIndex<T>
	 */
	public function createIndex(): ArrayIndex;

	/**
	 * @return string[]
	 */
	public function getSymbols(): array;

	/**
	 * @return Traversable<T>&Generator<T>
	 */
	public function getIterator(): Traversable;

	public function count(bool $throw = true): int;

}
