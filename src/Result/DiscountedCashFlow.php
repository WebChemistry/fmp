<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class DiscountedCashFlow extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', 'date', 'dcf', 'stockPrice'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getDate(): \DateTime
	{
		$value = ArrayTypeAssert::string($this->data, 'date', fn (): string => sprintf('%s of %s', 'date', $this->getSymbol()));

		$value = $this->dateTime($value);

		return $value;
	}


	public function getDcf(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'dcf', fn (): string => sprintf('%s of %s', 'dcf', $this->getSymbol()));
	}


	public function getStockPrice(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'Stock Price', fn (): string => sprintf('%s of %s', 'Stock Price', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
