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
		return ArrayTypeAssert::floatOrNull($this->data, '1D', fn () => sprintf('%s of %s', '1D', $this->getSymbol()));
	}


	public function get5D(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '5D', fn () => sprintf('%s of %s', '5D', $this->getSymbol()));
	}


	public function get1M(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '1M', fn () => sprintf('%s of %s', '1M', $this->getSymbol()));
	}


	public function get3M(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '3M', fn () => sprintf('%s of %s', '3M', $this->getSymbol()));
	}


	public function get6M(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '6M', fn () => sprintf('%s of %s', '6M', $this->getSymbol()));
	}


	public function getYtd(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, 'ytd', fn () => sprintf('%s of %s', 'ytd', $this->getSymbol()));
	}


	public function get1Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '1Y', fn () => sprintf('%s of %s', '1Y', $this->getSymbol()));
	}


	public function get3Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '3Y', fn () => sprintf('%s of %s', '3Y', $this->getSymbol()));
	}


	public function get5Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '5Y', fn () => sprintf('%s of %s', '5Y', $this->getSymbol()));
	}


	public function get10Y(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, '10Y', fn () => sprintf('%s of %s', '10Y', $this->getSymbol()));
	}


	public function getMax(): float|null
	{
		return ArrayTypeAssert::floatOrNull($this->data, 'max', fn () => sprintf('%s of %s', 'max', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
