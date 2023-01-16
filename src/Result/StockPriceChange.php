<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class StockPriceChange extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', '1D', '5D', '1M', '3M', '6M', 'ytd', '1Y', '3Y', '5Y', '10Y', 'max'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function get1D(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '1D', fn (): string => $this->getSymbol());
	}


	public function get5D(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '5D', fn (): string => $this->getSymbol());
	}


	public function get1M(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '1M', fn (): string => $this->getSymbol());
	}


	public function get3M(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '3M', fn (): string => $this->getSymbol());
	}


	public function get6M(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '6M', fn (): string => $this->getSymbol());
	}


	public function getYtd(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, 'ytd', fn (): string => $this->getSymbol());
	}


	public function get1Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '1Y', fn (): string => $this->getSymbol());
	}


	public function get3Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '3Y', fn (): string => $this->getSymbol());
	}


	public function get5Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '5Y', fn (): string => $this->getSymbol());
	}


	public function get10Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '10Y', fn (): string => $this->getSymbol());
	}


	public function getMax(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, 'max', fn (): string => $this->getSymbol());
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
