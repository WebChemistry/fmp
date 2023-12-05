<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class SplitCalendarRecord extends FmpResult
{
	public const META_FIELDS = ['symbol', 'date', 'label', 'numerator', 'denominator'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getDate(): \DateTime
	{
		$value = ArrayTypeAssert::string($this->data, 'date');

		$value = $this->dateTime($value);

		return $value;
	}


	public function getLabel(): string
	{
		return ArrayTypeAssert::string($this->data, 'label');
	}


	public function getNumerator(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'numerator');
	}


	public function getDenominator(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'denominator');
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
