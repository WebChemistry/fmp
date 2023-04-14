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
		if (($this->data['peRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'peRatioTTM', fn (): string => sprintf('%s of %s', 'peRatioTTM', $this->getSymbol()));
	}


	public function getPegRatio(): float|null
	{
		if (($this->data['pegRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'pegRatioTTM', fn (): string => sprintf('%s of %s', 'pegRatioTTM', $this->getSymbol()));
	}


	public function getPayoutRatio(): float|null
	{
		if (($this->data['payoutRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'payoutRatioTTM', fn (): string => sprintf('%s of %s', 'payoutRatioTTM', $this->getSymbol()));
	}


	public function getCurrentRatio(): float|null
	{
		if (($this->data['currentRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'currentRatioTTM', fn (): string => sprintf('%s of %s', 'currentRatioTTM', $this->getSymbol()));
	}


	public function getQuickRatio(): float|null
	{
		if (($this->data['quickRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'quickRatioTTM', fn (): string => sprintf('%s of %s', 'quickRatioTTM', $this->getSymbol()));
	}


	public function getCashRatio(): float|null
	{
		if (($this->data['cashRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'cashRatioTTM', fn (): string => sprintf('%s of %s', 'cashRatioTTM', $this->getSymbol()));
	}


	public function getDaysOfSalesOutstanding(): float|null
	{
		if (($this->data['daysOfSalesOutstandingTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'daysOfSalesOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysOfSalesOutstandingTTM', $this->getSymbol()));
	}


	public function getDaysOfInventoryOutstanding(): float|null
	{
		if (($this->data['daysOfInventoryOutstandingTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'daysOfInventoryOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysOfInventoryOutstandingTTM', $this->getSymbol()));
	}


	public function getOperatingCycle(): float|null
	{
		if (($this->data['operatingCycleTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'operatingCycleTTM', fn (): string => sprintf('%s of %s', 'operatingCycleTTM', $this->getSymbol()));
	}


	public function getDaysOfPayablesOutstanding(): float|null
	{
		if (($this->data['daysOfPayablesOutstandingTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'daysOfPayablesOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysOfPayablesOutstandingTTM', $this->getSymbol()));
	}


	public function getCashConversionCycle(): float|null
	{
		if (($this->data['cashConversionCycleTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'cashConversionCycleTTM', fn (): string => sprintf('%s of %s', 'cashConversionCycleTTM', $this->getSymbol()));
	}


	public function getGrossProfitMargin(): float|null
	{
		if (($this->data['grossProfitMarginTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'grossProfitMarginTTM', fn (): string => sprintf('%s of %s', 'grossProfitMarginTTM', $this->getSymbol()));
	}


	public function getOperatingProfitMargin(): float|null
	{
		if (($this->data['operatingProfitMarginTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'operatingProfitMarginTTM', fn (): string => sprintf('%s of %s', 'operatingProfitMarginTTM', $this->getSymbol()));
	}


	public function getPretaxProfitMargin(): float|null
	{
		if (($this->data['pretaxProfitMarginTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'pretaxProfitMarginTTM', fn (): string => sprintf('%s of %s', 'pretaxProfitMarginTTM', $this->getSymbol()));
	}


	public function getNetProfitMargin(): float|null
	{
		if (($this->data['netProfitMarginTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'netProfitMarginTTM', fn (): string => sprintf('%s of %s', 'netProfitMarginTTM', $this->getSymbol()));
	}


	public function getEffectiveTaxRate(): float|null
	{
		if (($this->data['effectiveTaxRateTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'effectiveTaxRateTTM', fn (): string => sprintf('%s of %s', 'effectiveTaxRateTTM', $this->getSymbol()));
	}


	public function getReturnOnAssets(): float|null
	{
		if (($this->data['returnOnAssetsTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'returnOnAssetsTTM', fn (): string => sprintf('%s of %s', 'returnOnAssetsTTM', $this->getSymbol()));
	}


	public function getReturnOnEquity(): float|null
	{
		if (($this->data['returnOnEquityTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'returnOnEquityTTM', fn (): string => sprintf('%s of %s', 'returnOnEquityTTM', $this->getSymbol()));
	}


	public function getReturnOnCapitalEmployed(): float|null
	{
		if (($this->data['returnOnCapitalEmployedTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'returnOnCapitalEmployedTTM', fn (): string => sprintf('%s of %s', 'returnOnCapitalEmployedTTM', $this->getSymbol()));
	}


	public function getNetIncomePerEBT(): float|null
	{
		if (($this->data['netIncomePerEBTTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'netIncomePerEBTTTM', fn (): string => sprintf('%s of %s', 'netIncomePerEBTTTM', $this->getSymbol()));
	}


	public function getEbtPerEbit(): float|null
	{
		if (($this->data['ebtPerEbitTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'ebtPerEbitTTM', fn (): string => sprintf('%s of %s', 'ebtPerEbitTTM', $this->getSymbol()));
	}


	public function getEbitPerRevenue(): float|null
	{
		if (($this->data['ebitPerRevenueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'ebitPerRevenueTTM', fn (): string => sprintf('%s of %s', 'ebitPerRevenueTTM', $this->getSymbol()));
	}


	public function getDebtRatio(): float|null
	{
		if (($this->data['debtRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'debtRatioTTM', fn (): string => sprintf('%s of %s', 'debtRatioTTM', $this->getSymbol()));
	}


	public function getDebtEquityRatio(): float|null
	{
		if (($this->data['debtEquityRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'debtEquityRatioTTM', fn (): string => sprintf('%s of %s', 'debtEquityRatioTTM', $this->getSymbol()));
	}


	public function getLongTermDebtToCapitalization(): float|null
	{
		if (($this->data['longTermDebtToCapitalizationTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'longTermDebtToCapitalizationTTM', fn (): string => sprintf('%s of %s', 'longTermDebtToCapitalizationTTM', $this->getSymbol()));
	}


	public function getTotalDebtToCapitalization(): float|null
	{
		if (($this->data['totalDebtToCapitalizationTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'totalDebtToCapitalizationTTM', fn (): string => sprintf('%s of %s', 'totalDebtToCapitalizationTTM', $this->getSymbol()));
	}


	public function getInterestCoverage(): float|null
	{
		if (($this->data['interestCoverageTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'interestCoverageTTM', fn (): string => sprintf('%s of %s', 'interestCoverageTTM', $this->getSymbol()));
	}


	public function getCashFlowToDebtRatio(): float|null
	{
		if (($this->data['cashFlowToDebtRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'cashFlowToDebtRatioTTM', fn (): string => sprintf('%s of %s', 'cashFlowToDebtRatioTTM', $this->getSymbol()));
	}


	public function getCompanyEquityMultiplier(): float|null
	{
		if (($this->data['companyEquityMultiplierTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'companyEquityMultiplierTTM', fn (): string => sprintf('%s of %s', 'companyEquityMultiplierTTM', $this->getSymbol()));
	}


	public function getReceivablesTurnover(): float|null
	{
		if (($this->data['receivablesTurnoverTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'receivablesTurnoverTTM', fn (): string => sprintf('%s of %s', 'receivablesTurnoverTTM', $this->getSymbol()));
	}


	public function getPayablesTurnover(): float|null
	{
		if (($this->data['payablesTurnoverTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'payablesTurnoverTTM', fn (): string => sprintf('%s of %s', 'payablesTurnoverTTM', $this->getSymbol()));
	}


	public function getInventoryTurnover(): float|null
	{
		if (($this->data['inventoryTurnoverTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'inventoryTurnoverTTM', fn (): string => sprintf('%s of %s', 'inventoryTurnoverTTM', $this->getSymbol()));
	}


	public function getFixedAssetTurnover(): float|null
	{
		if (($this->data['fixedAssetTurnoverTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'fixedAssetTurnoverTTM', fn (): string => sprintf('%s of %s', 'fixedAssetTurnoverTTM', $this->getSymbol()));
	}


	public function getAssetTurnover(): float|null
	{
		if (($this->data['assetTurnoverTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'assetTurnoverTTM', fn (): string => sprintf('%s of %s', 'assetTurnoverTTM', $this->getSymbol()));
	}


	public function getOperatingCashFlowPerShare(): float|null
	{
		if (($this->data['operatingCashFlowPerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'operatingCashFlowPerShareTTM', fn (): string => sprintf('%s of %s', 'operatingCashFlowPerShareTTM', $this->getSymbol()));
	}


	public function getFreeCashFlowPerShare(): float|null
	{
		if (($this->data['freeCashFlowPerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'freeCashFlowPerShareTTM', fn (): string => sprintf('%s of %s', 'freeCashFlowPerShareTTM', $this->getSymbol()));
	}


	public function getCashPerShare(): float|null
	{
		if (($this->data['cashPerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'cashPerShareTTM', fn (): string => sprintf('%s of %s', 'cashPerShareTTM', $this->getSymbol()));
	}


	public function getOperatingCashFlowSalesRatio(): float|null
	{
		if (($this->data['operatingCashFlowSalesRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'operatingCashFlowSalesRatioTTM', fn (): string => sprintf('%s of %s', 'operatingCashFlowSalesRatioTTM', $this->getSymbol()));
	}


	public function getFreeCashFlowOperatingCashFlowRatio(): float|null
	{
		if (($this->data['freeCashFlowOperatingCashFlowRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'freeCashFlowOperatingCashFlowRatioTTM', fn (): string => sprintf('%s of %s', 'freeCashFlowOperatingCashFlowRatioTTM', $this->getSymbol()));
	}


	public function getCashFlowCoverageRatios(): float|null
	{
		if (($this->data['cashFlowCoverageRatiosTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'cashFlowCoverageRatiosTTM', fn (): string => sprintf('%s of %s', 'cashFlowCoverageRatiosTTM', $this->getSymbol()));
	}


	public function getShortTermCoverageRatios(): float|null
	{
		if (($this->data['shortTermCoverageRatiosTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'shortTermCoverageRatiosTTM', fn (): string => sprintf('%s of %s', 'shortTermCoverageRatiosTTM', $this->getSymbol()));
	}


	public function getCapitalExpenditureCoverageRatio(): float|null
	{
		if (($this->data['capitalExpenditureCoverageRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'capitalExpenditureCoverageRatioTTM', fn (): string => sprintf('%s of %s', 'capitalExpenditureCoverageRatioTTM', $this->getSymbol()));
	}


	public function getDividendPaidAndCapexCoverageRatio(): float|null
	{
		if (($this->data['dividendPaidAndCapexCoverageRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'dividendPaidAndCapexCoverageRatioTTM', fn (): string => sprintf('%s of %s', 'dividendPaidAndCapexCoverageRatioTTM', $this->getSymbol()));
	}


	public function getPriceBookValueRatio(): float|null
	{
		if (($this->data['priceBookValueRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceBookValueRatioTTM', fn (): string => sprintf('%s of %s', 'priceBookValueRatioTTM', $this->getSymbol()));
	}


	public function getPriceToBookRatio(): float|null
	{
		if (($this->data['priceToBookRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceToBookRatioTTM', fn (): string => sprintf('%s of %s', 'priceToBookRatioTTM', $this->getSymbol()));
	}


	public function getPriceToSalesRatio(): float|null
	{
		if (($this->data['priceToSalesRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceToSalesRatioTTM', fn (): string => sprintf('%s of %s', 'priceToSalesRatioTTM', $this->getSymbol()));
	}


	public function getPriceEarningsRatio(): float|null
	{
		if (($this->data['priceEarningsRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceEarningsRatioTTM', fn (): string => sprintf('%s of %s', 'priceEarningsRatioTTM', $this->getSymbol()));
	}


	public function getPriceToFreeCashFlowsRatio(): float|null
	{
		if (($this->data['priceToFreeCashFlowsRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceToFreeCashFlowsRatioTTM', fn (): string => sprintf('%s of %s', 'priceToFreeCashFlowsRatioTTM', $this->getSymbol()));
	}


	public function getPriceToOperatingCashFlowsRatio(): float|null
	{
		if (($this->data['priceToOperatingCashFlowsRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceToOperatingCashFlowsRatioTTM', fn (): string => sprintf('%s of %s', 'priceToOperatingCashFlowsRatioTTM', $this->getSymbol()));
	}


	public function getPriceCashFlowRatio(): float|null
	{
		if (($this->data['priceCashFlowRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceCashFlowRatioTTM', fn (): string => sprintf('%s of %s', 'priceCashFlowRatioTTM', $this->getSymbol()));
	}


	public function getPriceEarningsToGrowthRatio(): float|null
	{
		if (($this->data['priceEarningsToGrowthRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceEarningsToGrowthRatioTTM', fn (): string => sprintf('%s of %s', 'priceEarningsToGrowthRatioTTM', $this->getSymbol()));
	}


	public function getPriceSalesRatio(): float|null
	{
		if (($this->data['priceSalesRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceSalesRatioTTM', fn (): string => sprintf('%s of %s', 'priceSalesRatioTTM', $this->getSymbol()));
	}


	public function getDividendYield(): float|null
	{
		if (($this->data['dividendYieldTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'dividendYieldTTM', fn (): string => sprintf('%s of %s', 'dividendYieldTTM', $this->getSymbol()));
	}


	public function getEnterpriseValueMultiple(): float|null
	{
		if (($this->data['enterpriseValueMultipleTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'enterpriseValueMultipleTTM', fn (): string => sprintf('%s of %s', 'enterpriseValueMultipleTTM', $this->getSymbol()));
	}


	public function getPriceFairValue(): float|null
	{
		if (($this->data['priceFairValueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceFairValueTTM', fn (): string => sprintf('%s of %s', 'priceFairValueTTM', $this->getSymbol()));
	}


	public function getDividendPerShare(): float|null
	{
		if (($this->data['dividendPerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'dividendPerShareTTM', fn (): string => sprintf('%s of %s', 'dividendPerShareTTM', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
