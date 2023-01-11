<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Utility;

use BackedEnum;
use OutOfBoundsException;
use Stringable;

/**
 * @template T
 */
final class ArrayIndex
{

	/** @var callable(T): (string|int) */
	private $maker;

	/** @var array<string|int, array<int, string|int>> */
	private array $index;

	/** @var (callable(string): string)|null */
	private $normalizer;

	/**
	 * @param T[] $array
	 * @param callable(T): (string|int) $maker
	 * @param (callable(string): string)|null $normalizer
	 */
	public function __construct(
		private array $array,
		callable $maker,
		?callable $normalizer = null,
	)
	{
		$this->maker = $maker;
		$this->normalizer = $normalizer;
	}

	public function has(string|int|Stringable|BackedEnum $name): bool
	{
		return array_key_exists($this->normalize($name), $this->index());
	}

	/**
	 * @return T
	 */
	public function get(string|int|Stringable|BackedEnum $name): mixed
	{
		$name = $this->normalize($name);

		if (!$this->has($name)) {
			throw new OutOfBoundsException(sprintf('Key "%s" not found in index.', $name));
		}

		return $this->array[$this->index()[$name][0]];
	}

	/**
	 * @return T|null
	 */
	public function find(string|int|Stringable|BackedEnum $name): mixed
	{
		$name = $this->normalize($name);

		if (!$this->has($name)) {
			return null;
		}

		return $this->array[$this->index()[$name][0]];
	}

	/**
	 * @return T[]
	 */
	public function search(string|int|Stringable|BackedEnum $name): array
	{
		$array = [];
		$name = $this->normalize($name);

		foreach ($this->index()[$name] as $key) {
			$array[] = $this->array[$key] ?? throw new OutOfBoundsException('Unexpected error.');
		}

		return $array;
	}

	/**
	 * @return array<string|int, array<int, string|int>>
	 */
	private function index(): array
	{
		if (!isset($this->index)) {
			$this->index = [];

			foreach ($this->array as $key => $value) {
				$this->index[$this->normalize(($this->maker)($value))][] = $key;
			}
		}

		return $this->index;
	}

	private function normalize(string|int|Stringable|BackedEnum $key): string
	{
		$key = $key instanceof BackedEnum ? (string) $key->value : (string) $key;

		if (!$this->normalizer) {
			return $key;
		}

		return ($this->normalizer)($key);
	}

}

