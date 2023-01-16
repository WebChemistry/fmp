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
		$value = ArrayTypeAssert::floatish($this->data, 'peRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPegRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pegRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPayoutRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'payoutRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCurrentRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'currentRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getQuickRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'quickRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfSalesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfSalesOutstandingTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfInventoryOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfInventoryOutstandingTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingCycle(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingCycleTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfPayablesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfPayablesOutstandingTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashConversionCycle(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashConversionCycleTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrossProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grossProfitMarginTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingProfitMarginTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPretaxProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pretaxProfitMarginTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetProfitMargin(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netProfitMarginTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEffectiveTaxRate(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'effectiveTaxRateTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnAssetsTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnEquity(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnEquityTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnCapitalEmployed(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnCapitalEmployedTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetIncomePerEBT(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netIncomePerEBTTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEbtPerEbit(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'ebtPerEbitTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEbitPerRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'ebitPerRevenueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtEquityRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtEquityRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getLongTermDebtToCapitalization(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'longTermDebtToCapitalizationTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTotalDebtToCapitalization(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'totalDebtToCapitalizationTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInterestCoverage(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestCoverageTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashFlowToDebtRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashFlowToDebtRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCompanyEquityMultiplier(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'companyEquityMultiplierTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReceivablesTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'receivablesTurnoverTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPayablesTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'payablesTurnoverTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInventoryTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'inventoryTurnoverTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFixedAssetTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'fixedAssetTurnoverTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAssetTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'assetTurnoverTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingCashFlowPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingCashFlowPerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFreeCashFlowPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'freeCashFlowPerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashPerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingCashFlowSalesRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingCashFlowSalesRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFreeCashFlowOperatingCashFlowRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'freeCashFlowOperatingCashFlowRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashFlowCoverageRatios(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashFlowCoverageRatiosTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getShortTermCoverageRatios(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'shortTermCoverageRatiosTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapitalExpenditureCoverageRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capitalExpenditureCoverageRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendPaidAndCapexCoverageRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendPaidAndCapexCoverageRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceBookValueRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceBookValueRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToBookRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToBookRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToSalesRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToSalesRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceEarningsRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceEarningsRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToFreeCashFlowsRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToFreeCashFlowsRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToOperatingCashFlowsRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToOperatingCashFlowsRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceCashFlowRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceCashFlowRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceEarningsToGrowthRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceEarningsToGrowthRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceSalesRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceSalesRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendYield(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendYieldTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEnterpriseValueMultiple(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'enterpriseValueMultipleTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceFairValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceFairValueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendPerShareTTM', fn (): string => $this->getSymbol());

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
