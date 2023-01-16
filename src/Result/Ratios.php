<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class Ratios extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'peRatio',
		'pegRatio',
		'payoutRatio',
		'currentRatio',
		'quickRatio',
		'cashRatio',
		'daysOfSalesOutstanding',
		'daysOfInventoryOutstanding',
		'operatingCycle',
		'daysOfPayablesOutstanding',
		'cashConversionCycle',
		'grossProfitMargin',
		'operatingProfitMargin',
		'pretaxProfitMargin',
		'netProfitMargin',
		'effectiveTaxRate',
		'returnOnAssets',
		'returnOnEquity',
		'returnOnCapitalEmployed',
		'netIncomePerEBT',
		'ebtPerEbit',
		'ebitPerRevenue',
		'debtRatio',
		'debtEquityRatio',
		'longTermDebtToCapitalization',
		'totalDebtToCapitalization',
		'interestCoverage',
		'cashFlowToDebtRatio',
		'companyEquityMultiplier',
		'receivablesTurnover',
		'payablesTurnover',
		'inventoryTurnover',
		'fixedAssetTurnover',
		'assetTurnover',
		'operatingCashFlowPerShare',
		'freeCashFlowPerShare',
		'cashPerShare',
		'operatingCashFlowSalesRatio',
		'freeCashFlowOperatingCashFlowRatio',
		'cashFlowCoverageRatios',
		'shortTermCoverageRatios',
		'capitalExpenditureCoverageRatio',
		'dividendPaidAndCapexCoverageRatio',
		'priceBookValueRatio',
		'priceToBookRatio',
		'priceToSalesRatio',
		'priceEarningsRatio',
		'priceToFreeCashFlowsRatio',
		'priceToOperatingCashFlowsRatio',
		'priceCashFlowRatio',
		'priceEarningsToGrowthRatio',
		'priceSalesRatio',
		'dividendYield',
		'enterpriseValueMultiple',
		'priceFairValue',
		'dividendPerShare',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getPeRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'peRatioTTM', fn (): string => sprintf('%s of %s', 'peRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPegRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pegRatioTTM', fn (): string => sprintf('%s of %s', 'pegRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPayoutRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'payoutRatioTTM', fn (): string => sprintf('%s of %s', 'payoutRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCurrentRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'currentRatioTTM', fn (): string => sprintf('%s of %s', 'currentRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getQuickRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'quickRatioTTM', fn (): string => sprintf('%s of %s', 'quickRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashRatioTTM', fn (): string => sprintf('%s of %s', 'cashRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfSalesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfSalesOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysOfSalesOutstandingTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfInventoryOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfInventoryOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysOfInventoryOutstandingTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingCycle(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingCycleTTM', fn (): string => sprintf('%s of %s', 'operatingCycleTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfPayablesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfPayablesOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysOfPayablesOutstandingTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashConversionCycle(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashConversionCycleTTM', fn (): string => sprintf('%s of %s', 'cashConversionCycleTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrossProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grossProfitMarginTTM', fn (): string => sprintf('%s of %s', 'grossProfitMarginTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingProfitMarginTTM', fn (): string => sprintf('%s of %s', 'operatingProfitMarginTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPretaxProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pretaxProfitMarginTTM', fn (): string => sprintf('%s of %s', 'pretaxProfitMarginTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netProfitMarginTTM', fn (): string => sprintf('%s of %s', 'netProfitMarginTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEffectiveTaxRate(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'effectiveTaxRateTTM', fn (): string => sprintf('%s of %s', 'effectiveTaxRateTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnAssetsTTM', fn (): string => sprintf('%s of %s', 'returnOnAssetsTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnEquity(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnEquityTTM', fn (): string => sprintf('%s of %s', 'returnOnEquityTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnCapitalEmployed(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnCapitalEmployedTTM', fn (): string => sprintf('%s of %s', 'returnOnCapitalEmployedTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetIncomePerEBT(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netIncomePerEBTTTM', fn (): string => sprintf('%s of %s', 'netIncomePerEBTTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEbtPerEbit(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'ebtPerEbitTTM', fn (): string => sprintf('%s of %s', 'ebtPerEbitTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEbitPerRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'ebitPerRevenueTTM', fn (): string => sprintf('%s of %s', 'ebitPerRevenueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtRatioTTM', fn (): string => sprintf('%s of %s', 'debtRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtEquityRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtEquityRatioTTM', fn (): string => sprintf('%s of %s', 'debtEquityRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getLongTermDebtToCapitalization(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'longTermDebtToCapitalizationTTM', fn (): string => sprintf('%s of %s', 'longTermDebtToCapitalizationTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTotalDebtToCapitalization(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'totalDebtToCapitalizationTTM', fn (): string => sprintf('%s of %s', 'totalDebtToCapitalizationTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInterestCoverage(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestCoverageTTM', fn (): string => sprintf('%s of %s', 'interestCoverageTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashFlowToDebtRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashFlowToDebtRatioTTM', fn (): string => sprintf('%s of %s', 'cashFlowToDebtRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCompanyEquityMultiplier(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'companyEquityMultiplierTTM', fn (): string => sprintf('%s of %s', 'companyEquityMultiplierTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReceivablesTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'receivablesTurnoverTTM', fn (): string => sprintf('%s of %s', 'receivablesTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPayablesTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'payablesTurnoverTTM', fn (): string => sprintf('%s of %s', 'payablesTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInventoryTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'inventoryTurnoverTTM', fn (): string => sprintf('%s of %s', 'inventoryTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFixedAssetTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'fixedAssetTurnoverTTM', fn (): string => sprintf('%s of %s', 'fixedAssetTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAssetTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'assetTurnoverTTM', fn (): string => sprintf('%s of %s', 'assetTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingCashFlowPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingCashFlowPerShareTTM', fn (): string => sprintf('%s of %s', 'operatingCashFlowPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFreeCashFlowPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'freeCashFlowPerShareTTM', fn (): string => sprintf('%s of %s', 'freeCashFlowPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashPerShareTTM', fn (): string => sprintf('%s of %s', 'cashPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingCashFlowSalesRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingCashFlowSalesRatioTTM', fn (): string => sprintf('%s of %s', 'operatingCashFlowSalesRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFreeCashFlowOperatingCashFlowRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'freeCashFlowOperatingCashFlowRatioTTM', fn (): string => sprintf('%s of %s', 'freeCashFlowOperatingCashFlowRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashFlowCoverageRatios(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashFlowCoverageRatiosTTM', fn (): string => sprintf('%s of %s', 'cashFlowCoverageRatiosTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getShortTermCoverageRatios(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'shortTermCoverageRatiosTTM', fn (): string => sprintf('%s of %s', 'shortTermCoverageRatiosTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapitalExpenditureCoverageRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capitalExpenditureCoverageRatioTTM', fn (): string => sprintf('%s of %s', 'capitalExpenditureCoverageRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendPaidAndCapexCoverageRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendPaidAndCapexCoverageRatioTTM', fn (): string => sprintf('%s of %s', 'dividendPaidAndCapexCoverageRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceBookValueRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceBookValueRatioTTM', fn (): string => sprintf('%s of %s', 'priceBookValueRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToBookRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToBookRatioTTM', fn (): string => sprintf('%s of %s', 'priceToBookRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToSalesRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToSalesRatioTTM', fn (): string => sprintf('%s of %s', 'priceToSalesRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceEarningsRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceEarningsRatioTTM', fn (): string => sprintf('%s of %s', 'priceEarningsRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToFreeCashFlowsRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToFreeCashFlowsRatioTTM', fn (): string => sprintf('%s of %s', 'priceToFreeCashFlowsRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToOperatingCashFlowsRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToOperatingCashFlowsRatioTTM', fn (): string => sprintf('%s of %s', 'priceToOperatingCashFlowsRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceCashFlowRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceCashFlowRatioTTM', fn (): string => sprintf('%s of %s', 'priceCashFlowRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceEarningsToGrowthRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceEarningsToGrowthRatioTTM', fn (): string => sprintf('%s of %s', 'priceEarningsToGrowthRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceSalesRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceSalesRatioTTM', fn (): string => sprintf('%s of %s', 'priceSalesRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendYield(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendYieldTTM', fn (): string => sprintf('%s of %s', 'dividendYieldTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEnterpriseValueMultiple(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'enterpriseValueMultipleTTM', fn (): string => sprintf('%s of %s', 'enterpriseValueMultipleTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceFairValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceFairValueTTM', fn (): string => sprintf('%s of %s', 'priceFairValueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendPerShareTTM', fn (): string => sprintf('%s of %s', 'dividendPerShareTTM', $this->getSymbol()));

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
