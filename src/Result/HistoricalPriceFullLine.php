<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class HistoricalPriceFullLine extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', 'historical'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	/**
	 * @return HistoricalLine[]
	 */
	public function getHistorical(): array
	{
		$value = ArrayTypeAssert::array($this->data, 'historical', fn (): string => sprintf('%s of %s', 'historical', $this->getSymbol()));

		$array = [];

		foreach ($value as $item) {
			$array[] = new HistoricalLine($item);
		}

		return $array;
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
