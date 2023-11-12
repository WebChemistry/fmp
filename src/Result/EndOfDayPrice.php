<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class EndOfDayPrice extends FmpResult
{
	public const META_FIELDS = ['symbol', 'date', 'open', 'low', 'high', 'close', 'adjClose', 'volume'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getDate(): string
	{
		return ArrayTypeAssert::string($this->data, 'date');
	}


	public function getOpen(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'open');

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getLow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'low');

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getHigh(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'high');

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getClose(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'close');

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAdjClose(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'adjClose');

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getVolume(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'volume');

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
