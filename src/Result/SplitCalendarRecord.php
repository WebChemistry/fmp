<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class SplitCalendarRecord extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', 'date', 'label', 'numerator', 'denominator'];

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


	public function getLabel(): string
	{
		return ArrayTypeAssert::string($this->data, 'label', fn (): string => sprintf('%s of %s', 'label', $this->getSymbol()));
	}


	public function getNumerator(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'numerator', fn (): string => sprintf('%s of %s', 'numerator', $this->getSymbol()));
	}


	public function getDenominator(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'denominator', fn (): string => sprintf('%s of %s', 'denominator', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
