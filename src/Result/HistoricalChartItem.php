<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use DateTime;
use Typertion\Php\ArrayTypeAssert;

final class HistoricalChartItem extends FmpResult
{
	public const META_FIELDS = ['date', 'open', 'low', 'high', 'close', 'volume'];

	public function getDate(): DateTime
	{
		$value = ArrayTypeAssert::string($this->data, 'date');

		$value = $this->dateTime($value);

		return $value;
	}


	public function getOpen(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'open');
	}


	public function getLow(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'low');
	}


	public function getHigh(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'high');
	}


	public function getClose(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'close');
	}


	public function getVolume(): int
	{
		return ArrayTypeAssert::int($this->data, 'volume');
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
