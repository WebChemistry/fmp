<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class EndOfDayPrice extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', 'date', 'open', 'low', 'high', 'close', 'adjClose', 'volume'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getDate(): string
	{
		return ArrayTypeAssert::string($this->data, 'date', fn (): string => sprintf('%s of %s', 'date', $this->getSymbol()));
	}


	public function getOpen(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'open', fn (): string => sprintf('%s of %s', 'open', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getLow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'low', fn (): string => sprintf('%s of %s', 'low', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getHigh(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'high', fn (): string => sprintf('%s of %s', 'high', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getClose(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'close', fn (): string => sprintf('%s of %s', 'close', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAdjClose(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'adjClose', fn (): string => sprintf('%s of %s', 'adjClose', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getVolume(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'volume', fn (): string => sprintf('%s of %s', 'volume', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
