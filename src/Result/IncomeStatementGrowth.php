<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class IncomeStatementGrowth extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'date',
		'period',
		'growthRevenue',
		'growthCostOfRevenue',
		'growthGrossProfit',
		'growthGrossProfitRatio',
		'growthResearchAndDevelopmentExpenses',
		'growthGeneralAndAdministrativeExpenses',
		'growthSellingAndMarketingExpenses',
		'growthOtherExpenses',
		'growthOperatingExpenses',
		'growthCostAndExpenses',
		'growthInterestExpense',
		'growthDepreciationAndAmortization',
		'growthEbitda',
		'growthEbitdaRatio',
		'growthOperatingIncome',
		'growthOperatingIncomeRatio',
		'growthTotalOtherIncomeExpensesNet',
		'growthIncomeBeforeTax',
		'growthIncomeBeforeTaxRatio',
		'growthIncomeTaxExpense',
		'growthNetIncome',
		'growthNetIncomeRatio',
		'growthEps',
		'growthEpsDiluted',
		'growthWeightedAverageShsOut',
		'growthWeightedAverageShsOutDil',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getDate(): string
	{
		return ArrayTypeAssert::string($this->data, 'date', fn (): string => sprintf('%s of %s', 'date', $this->getSymbol()));
	}


	public function getPeriod(): string
	{
		return ArrayTypeAssert::string($this->data, 'period', fn (): string => sprintf('%s of %s', 'period', $this->getSymbol()));
	}


	public function getGrowthRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthRevenue', fn (): string => sprintf('%s of %s', 'growthRevenue', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthCostOfRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthCostOfRevenue', fn (): string => sprintf('%s of %s', 'growthCostOfRevenue', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthGrossProfit(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthGrossProfit', fn (): string => sprintf('%s of %s', 'growthGrossProfit', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthGrossProfitRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthGrossProfitRatio', fn (): string => sprintf('%s of %s', 'growthGrossProfitRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthResearchAndDevelopmentExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthResearchAndDevelopmentExpenses', fn (): string => sprintf('%s of %s', 'growthResearchAndDevelopmentExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthGeneralAndAdministrativeExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthGeneralAndAdministrativeExpenses', fn (): string => sprintf('%s of %s', 'growthGeneralAndAdministrativeExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthSellingAndMarketingExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthSellingAndMarketingExpenses', fn (): string => sprintf('%s of %s', 'growthSellingAndMarketingExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthOtherExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthOtherExpenses', fn (): string => sprintf('%s of %s', 'growthOtherExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthOperatingExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthOperatingExpenses', fn (): string => sprintf('%s of %s', 'growthOperatingExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthCostAndExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthCostAndExpenses', fn (): string => sprintf('%s of %s', 'growthCostAndExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthInterestExpense(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthInterestExpense', fn (): string => sprintf('%s of %s', 'growthInterestExpense', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthDepreciationAndAmortization(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthDepreciationAndAmortization', fn (): string => sprintf('%s of %s', 'growthDepreciationAndAmortization', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthEbitda(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthEBITDA', fn (): string => sprintf('%s of %s', 'growthEBITDA', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthEbitdaRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthEBITDARatio', fn (): string => sprintf('%s of %s', 'growthEBITDARatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthOperatingIncome(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthOperatingIncome', fn (): string => sprintf('%s of %s', 'growthOperatingIncome', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthOperatingIncomeRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthOperatingIncomeRatio', fn (): string => sprintf('%s of %s', 'growthOperatingIncomeRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthTotalOtherIncomeExpensesNet(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthTotalOtherIncomeExpensesNet', fn (): string => sprintf('%s of %s', 'growthTotalOtherIncomeExpensesNet', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthIncomeBeforeTax(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthIncomeBeforeTax', fn (): string => sprintf('%s of %s', 'growthIncomeBeforeTax', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthIncomeBeforeTaxRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthIncomeBeforeTaxRatio', fn (): string => sprintf('%s of %s', 'growthIncomeBeforeTaxRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthIncomeTaxExpense(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthIncomeTaxExpense', fn (): string => sprintf('%s of %s', 'growthIncomeTaxExpense', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthNetIncome(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthNetIncome', fn (): string => sprintf('%s of %s', 'growthNetIncome', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthNetIncomeRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthNetIncomeRatio', fn (): string => sprintf('%s of %s', 'growthNetIncomeRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthEps(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthEPS', fn (): string => sprintf('%s of %s', 'growthEPS', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthEpsDiluted(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthEPSDiluted', fn (): string => sprintf('%s of %s', 'growthEPSDiluted', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthWeightedAverageShsOut(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthWeightedAverageShsOut', fn (): string => sprintf('%s of %s', 'growthWeightedAverageShsOut', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrowthWeightedAverageShsOutDil(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'growthWeightedAverageShsOutDil', fn (): string => sprintf('%s of %s', 'growthWeightedAverageShsOutDil', $this->getSymbol()));

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
