<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Response;

use LogicException;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Result\SymbolResult;
use WebChemistry\Fmp\Utility\ArrayIndex;

/**
 * @template T of FmpResult
 */
trait SymbolObjectsResponse
{

	/**
	 * @return ArrayIndex<T>
	 */
	public function createIndex(): ArrayIndex
	{
		if (!is_a($this->className, SymbolResult::class, true)) {
			throw new LogicException(sprintf('Class %s have to implement interface %s', $this->className, SymbolResult::class));
		}

		return new ArrayIndex($this->toObjects(), fn (SymbolResult $object): string => $object->getSymbol()); // @phpstan-ignore-line
	}

	/**
	 * @return string[]
	 */
	public function getSymbols(): array
	{
		if (!is_a($this->className, SymbolResult::class, true)) {
			throw new LogicException(sprintf('Class %s have to implement interface %s', $this->className, SymbolResult::class));
		}

		return array_map(
			fn (SymbolResult $object) => $object->getSymbol(), // @phpstan-ignore-line
			$this->toObjects(),
		);
	}

}
