<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class IncomeStatement extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'date',
		'symbol',
		'reportedCurrency',
		'cik',
		'fillingDate',
		'acceptedDate',
		'calendarYear',
		'period',
		'revenue',
		'costOfRevenue',
		'grossProfit',
		'grossProfitRatio',
		'researchAndDevelopmentExpenses',
		'generalAndAdministrativeExpenses',
		'sellingAndMarketingExpenses',
		'sellingGeneralAndAdministrativeExpenses',
		'otherExpenses',
		'operatingExpenses',
		'costAndExpenses',
		'interestExpense',
		'depreciationAndAmortization',
		'EBITDA',
		'EBITDARatio',
		'operatingIncome',
		'operatingIncomeRatio',
		'totalOtherIncomeExpensesNet',
		'incomeBeforeTax',
		'incomeBeforeTaxRatio',
		'incomeTaxExpense',
		'netIncome',
		'netIncomeRatio',
		'EPS',
		'EPSDiluted',
		'weightedAverageShsOut',
		'weightedAverageShsOutDil',
		'link',
		'finalLink',
		'interestIncome',
	];

	public function getDate(): string
	{
		return ArrayTypeAssert::string($this->data, 'date', fn (): string => sprintf('%s of %s', 'date', $this->getSymbol()));
	}


	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getReportedCurrency(): string
	{
		return ArrayTypeAssert::string($this->data, 'reportedCurrency', fn (): string => sprintf('%s of %s', 'reportedCurrency', $this->getSymbol()));
	}


	public function getCik(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'cik', fn (): string => sprintf('%s of %s', 'cik', $this->getSymbol()));
	}


	public function getFillingDate(): string
	{
		return ArrayTypeAssert::string($this->data, 'fillingDate', fn (): string => sprintf('%s of %s', 'fillingDate', $this->getSymbol()));
	}


	public function getAcceptedDate(): string|null
	{
		if (($this->data['acceptedDate'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'acceptedDate', fn (): string => sprintf('%s of %s', 'acceptedDate', $this->getSymbol()));
	}


	public function getCalendarYear(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'calendarYear', fn (): string => sprintf('%s of %s', 'calendarYear', $this->getSymbol()));
	}


	public function getPeriod(): string
	{
		return ArrayTypeAssert::string($this->data, 'period', fn (): string => sprintf('%s of %s', 'period', $this->getSymbol()));
	}


	public function getRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'revenue', fn (): string => sprintf('%s of %s', 'revenue', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCostOfRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'costOfRevenue', fn (): string => sprintf('%s of %s', 'costOfRevenue', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrossProfit(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grossProfit', fn (): string => sprintf('%s of %s', 'grossProfit', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrossProfitRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grossProfitRatio', fn (): string => sprintf('%s of %s', 'grossProfitRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getResearchAndDevelopmentExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'ResearchAndDevelopmentExpenses', fn (): string => sprintf('%s of %s', 'ResearchAndDevelopmentExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGeneralAndAdministrativeExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'GeneralAndAdministrativeExpenses', fn (): string => sprintf('%s of %s', 'GeneralAndAdministrativeExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getSellingAndMarketingExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'SellingAndMarketingExpenses', fn (): string => sprintf('%s of %s', 'SellingAndMarketingExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getSellingGeneralAndAdministrativeExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'SellingGeneralAndAdministrativeExpenses', fn (): string => sprintf('%s of %s', 'SellingGeneralAndAdministrativeExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOtherExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'otherExpenses', fn (): string => sprintf('%s of %s', 'otherExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingExpenses', fn (): string => sprintf('%s of %s', 'operatingExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCostAndExpenses(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'costAndExpenses', fn (): string => sprintf('%s of %s', 'costAndExpenses', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInterestExpense(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestExpense', fn (): string => sprintf('%s of %s', 'interestExpense', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDepreciationAndAmortization(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'depreciationAndAmortization', fn (): string => sprintf('%s of %s', 'depreciationAndAmortization', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEBITDA(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'EBITDA', fn (): string => sprintf('%s of %s', 'EBITDA', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEBITDARatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'EBITDARatio', fn (): string => sprintf('%s of %s', 'EBITDARatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingIncome(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingIncome', fn (): string => sprintf('%s of %s', 'operatingIncome', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingIncomeRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingIncomeRatio', fn (): string => sprintf('%s of %s', 'operatingIncomeRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTotalOtherIncomeExpensesNet(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'totalOtherIncomeExpensesNet', fn (): string => sprintf('%s of %s', 'totalOtherIncomeExpensesNet', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getIncomeBeforeTax(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'incomeBeforeTax', fn (): string => sprintf('%s of %s', 'incomeBeforeTax', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getIncomeBeforeTaxRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'incomeBeforeTaxRatio', fn (): string => sprintf('%s of %s', 'incomeBeforeTaxRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getIncomeTaxExpense(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'incomeTaxExpense', fn (): string => sprintf('%s of %s', 'incomeTaxExpense', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetIncome(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netIncome', fn (): string => sprintf('%s of %s', 'netIncome', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetIncomeRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netIncomeRatio', fn (): string => sprintf('%s of %s', 'netIncomeRatio', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEPS(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'EPS', fn (): string => sprintf('%s of %s', 'EPS', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEPSDiluted(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'EPSDiluted', fn (): string => sprintf('%s of %s', 'EPSDiluted', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getWeightedAverageShsOut(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'weightedAverageShsOut', fn (): string => sprintf('%s of %s', 'weightedAverageShsOut', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getWeightedAverageShsOutDil(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'weightedAverageShsOutDil', fn (): string => sprintf('%s of %s', 'weightedAverageShsOutDil', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getLink(): string|null
	{
		if (($this->data['link'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'link', fn (): string => sprintf('%s of %s', 'link', $this->getSymbol()));
	}


	public function getFinalLink(): string|null
	{
		if (($this->data['finalLink'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'finalLink', fn (): string => sprintf('%s of %s', 'finalLink', $this->getSymbol()));
	}


	public function getInterestIncome(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestIncome', fn (): string => sprintf('%s of %s', 'interestIncome', $this->getSymbol()));

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
