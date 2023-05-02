<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class PriceTarget extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'lastMonth',
		'lastMonthAvgPT',
		'lastMonthAvgPTPercentDif',
		'lastQuarter',
		'lastQuarterAvgPT',
		'lastQuarterAvgPTPercentDif',
		'lastYear',
		'lastYearAvgPT',
		'lastYearAvgPTPercentDif',
		'allTime',
		'allTimeAvgPT',
		'allTimeAvgPTPercentDif',
		'publishers',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getLastMonth(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastMonth', fn (): string => sprintf('%s of %s', 'lastMonth', $this->getSymbol()));
	}


	public function getLastMonthAvgPT(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastMonthAvgPT', fn (): string => sprintf('%s of %s', 'lastMonthAvgPT', $this->getSymbol()));
	}


	public function getLastMonthAvgPTPercentDif(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastMonthAvgPTPercentDif', fn (): string => sprintf('%s of %s', 'lastMonthAvgPTPercentDif', $this->getSymbol()));
	}


	public function getLastQuarter(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastQuarter', fn (): string => sprintf('%s of %s', 'lastQuarter', $this->getSymbol()));
	}


	public function getLastQuarterAvgPT(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastQuarterAvgPT', fn (): string => sprintf('%s of %s', 'lastQuarterAvgPT', $this->getSymbol()));
	}


	public function getLastQuarterAvgPTPercentDif(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastQuarterAvgPTPercentDif', fn (): string => sprintf('%s of %s', 'lastQuarterAvgPTPercentDif', $this->getSymbol()));
	}


	public function getLastYear(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastYear', fn (): string => sprintf('%s of %s', 'lastYear', $this->getSymbol()));
	}


	public function getLastYearAvgPT(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastYearAvgPT', fn (): string => sprintf('%s of %s', 'lastYearAvgPT', $this->getSymbol()));
	}


	public function getLastYearAvgPTPercentDif(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'lastYearAvgPTPercentDif', fn (): string => sprintf('%s of %s', 'lastYearAvgPTPercentDif', $this->getSymbol()));
	}


	public function getAllTime(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'allTime', fn (): string => sprintf('%s of %s', 'allTime', $this->getSymbol()));
	}


	public function getAllTimeAvgPT(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'allTimeAvgPT', fn (): string => sprintf('%s of %s', 'allTimeAvgPT', $this->getSymbol()));
	}


	public function getAllTimeAvgPTPercentDif(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'allTimeAvgPTPercentDif', fn (): string => sprintf('%s of %s', 'allTimeAvgPTPercentDif', $this->getSymbol()));
	}


	/**
	 * @return array<string>
	 */
	public function getPublishers(): array
	{
		$value = ArrayTypeAssert::string($this->data, 'publishers', fn (): string => sprintf('%s of %s', 'publishers', $this->getSymbol()));

		$value = array_map(fn (string $v): string => substr($v, 1, -1), explode(', ', substr($value, 1, -1)));

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
