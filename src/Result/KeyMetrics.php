<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class KeyMetrics extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'revenuePerShare',
		'netIncomePerShare',
		'operatingCashFlowPerShare',
		'freeCashFlowPerShare',
		'cashPerShare',
		'bookValuePerShare',
		'tangibleBookValuePerShare',
		'shareholdersEquityPerShare',
		'interestDebtPerShare',
		'marketCap',
		'enterpriseValue',
		'peRatio',
		'priceToSalesRatio',
		'pocfratio',
		'pfcfRatio',
		'pbRatio',
		'ptbRatio',
		'evToSales',
		'enterpriseValueOverEBITDA',
		'evToOperatingCashFlow',
		'evToFreeCashFlow',
		'earningsYield',
		'freeCashFlowYield',
		'debtToEquity',
		'debtToAssets',
		'netDebtToEBITDA',
		'currentRatio',
		'interestCoverage',
		'incomeQuality',
		'dividendYield',
		'dividendYieldPercentage',
		'payoutRatio',
		'salesGeneralAndAdministrativeToRevenue',
		'researchAndDevelopementToRevenue',
		'intangiblesToTotalAssets',
		'capexToOperatingCashFlow',
		'capexToRevenue',
		'capexToDepreciation',
		'stockBasedCompensationToRevenue',
		'grahamNumber',
		'roic',
		'returnOnTangibleAssets',
		'grahamNetNet',
		'workingCapital',
		'tangibleAssetValue',
		'netCurrentAssetValue',
		'investedCapital',
		'averageReceivables',
		'averagePayables',
		'averageInventory',
		'daysSalesOutstanding',
		'daysPayablesOutstanding',
		'daysOfInventoryOnHand',
		'receivablesTurnover',
		'payablesTurnover',
		'inventoryTurnover',
		'roe',
		'capexPerShare',
		'dividendPerShare',
		'debtToMarketCap',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getRevenuePerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'revenuePerShareTTM', fn () => sprintf('%s of %s', 'revenuePerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetIncomePerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netIncomePerShareTTM', fn () => sprintf('%s of %s', 'netIncomePerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOperatingCashFlowPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'operatingCashFlowPerShareTTM', fn () => sprintf('%s of %s', 'operatingCashFlowPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFreeCashFlowPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'freeCashFlowPerShareTTM', fn () => sprintf('%s of %s', 'freeCashFlowPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCashPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'cashPerShareTTM', fn () => sprintf('%s of %s', 'cashPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getBookValuePerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'bookValuePerShareTTM', fn () => sprintf('%s of %s', 'bookValuePerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTangibleBookValuePerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'tangibleBookValuePerShareTTM', fn () => sprintf('%s of %s', 'tangibleBookValuePerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getShareholdersEquityPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'shareholdersEquityPerShareTTM', fn () => sprintf('%s of %s', 'shareholdersEquityPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInterestDebtPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestDebtPerShareTTM', fn () => sprintf('%s of %s', 'interestDebtPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getMarketCap(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'marketCapTTM', fn () => sprintf('%s of %s', 'marketCapTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEnterpriseValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'enterpriseValueTTM', fn () => sprintf('%s of %s', 'enterpriseValueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPeRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'peRatioTTM', fn () => sprintf('%s of %s', 'peRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceToSalesRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'priceToSalesRatioTTM', fn () => sprintf('%s of %s', 'priceToSalesRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPocfratio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pocfratioTTM', fn () => sprintf('%s of %s', 'pocfratioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPfcfRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pfcfRatioTTM', fn () => sprintf('%s of %s', 'pfcfRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPbRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pbRatioTTM', fn () => sprintf('%s of %s', 'pbRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPtbRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'ptbRatioTTM', fn () => sprintf('%s of %s', 'ptbRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEvToSales(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'evToSalesTTM', fn () => sprintf('%s of %s', 'evToSalesTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEnterpriseValueOverEBITDA(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'enterpriseValueOverEBITDATTM', fn () => sprintf('%s of %s', 'enterpriseValueOverEBITDATTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEvToOperatingCashFlow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'evToOperatingCashFlowTTM', fn () => sprintf('%s of %s', 'evToOperatingCashFlowTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEvToFreeCashFlow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'evToFreeCashFlowTTM', fn () => sprintf('%s of %s', 'evToFreeCashFlowTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEarningsYield(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'earningsYieldTTM', fn () => sprintf('%s of %s', 'earningsYieldTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFreeCashFlowYield(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'freeCashFlowYieldTTM', fn () => sprintf('%s of %s', 'freeCashFlowYieldTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtToEquity(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtToEquityTTM', fn () => sprintf('%s of %s', 'debtToEquityTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtToAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtToAssetsTTM', fn () => sprintf('%s of %s', 'debtToAssetsTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetDebtToEBITDA(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netDebtToEBITDATTM', fn () => sprintf('%s of %s', 'netDebtToEBITDATTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCurrentRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'currentRatioTTM', fn () => sprintf('%s of %s', 'currentRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInterestCoverage(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestCoverageTTM', fn () => sprintf('%s of %s', 'interestCoverageTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getIncomeQuality(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'incomeQualityTTM', fn () => sprintf('%s of %s', 'incomeQualityTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendYield(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendYieldTTM', fn () => sprintf('%s of %s', 'dividendYieldTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendYieldPercentage(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendYieldPercentageTTM', fn () => sprintf('%s of %s', 'dividendYieldPercentageTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPayoutRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'payoutRatioTTM', fn () => sprintf('%s of %s', 'payoutRatioTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getSalesGeneralAndAdministrativeToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'salesGeneralAndAdministrativeToRevenueTTM', fn () => sprintf('%s of %s', 'salesGeneralAndAdministrativeToRevenueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getResearchAndDevelopementToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'researchAndDevelopementToRevenueTTM', fn () => sprintf('%s of %s', 'researchAndDevelopementToRevenueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getIntangiblesToTotalAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'intangiblesToTotalAssetsTTM', fn () => sprintf('%s of %s', 'intangiblesToTotalAssetsTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexToOperatingCashFlow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexToOperatingCashFlowTTM', fn () => sprintf('%s of %s', 'capexToOperatingCashFlowTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexToRevenueTTM', fn () => sprintf('%s of %s', 'capexToRevenueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexToDepreciation(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexToDepreciationTTM', fn () => sprintf('%s of %s', 'capexToDepreciationTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getStockBasedCompensationToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'stockBasedCompensationToRevenueTTM', fn () => sprintf('%s of %s', 'stockBasedCompensationToRevenueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrahamNumber(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grahamNumberTTM', fn () => sprintf('%s of %s', 'grahamNumberTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getRoic(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'roicTTM', fn () => sprintf('%s of %s', 'roicTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnTangibleAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnTangibleAssetsTTM', fn () => sprintf('%s of %s', 'returnOnTangibleAssetsTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrahamNetNet(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grahamNetNetTTM', fn () => sprintf('%s of %s', 'grahamNetNetTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getWorkingCapital(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'workingCapitalTTM', fn () => sprintf('%s of %s', 'workingCapitalTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTangibleAssetValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'tangibleAssetValueTTM', fn () => sprintf('%s of %s', 'tangibleAssetValueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetCurrentAssetValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netCurrentAssetValueTTM', fn () => sprintf('%s of %s', 'netCurrentAssetValueTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInvestedCapital(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'investedCapitalTTM', fn () => sprintf('%s of %s', 'investedCapitalTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAverageReceivables(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'averageReceivablesTTM', fn () => sprintf('%s of %s', 'averageReceivablesTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAveragePayables(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'averagePayablesTTM', fn () => sprintf('%s of %s', 'averagePayablesTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAverageInventory(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'averageInventoryTTM', fn () => sprintf('%s of %s', 'averageInventoryTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysSalesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysSalesOutstandingTTM', fn () => sprintf('%s of %s', 'daysSalesOutstandingTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysPayablesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysPayablesOutstandingTTM', fn () => sprintf('%s of %s', 'daysPayablesOutstandingTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfInventoryOnHand(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfInventoryOnHandTTM', fn () => sprintf('%s of %s', 'daysOfInventoryOnHandTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReceivablesTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'receivablesTurnoverTTM', fn () => sprintf('%s of %s', 'receivablesTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPayablesTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'payablesTurnoverTTM', fn () => sprintf('%s of %s', 'payablesTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInventoryTurnover(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'inventoryTurnoverTTM', fn () => sprintf('%s of %s', 'inventoryTurnoverTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getRoe(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'roeTTM', fn () => sprintf('%s of %s', 'roeTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexPerShareTTM', fn () => sprintf('%s of %s', 'capexPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDividendPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendPerShareTTM', fn () => sprintf('%s of %s', 'dividendPerShareTTM', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtToMarketCap(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtToMarketCapTTM', fn () => sprintf('%s of %s', 'debtToMarketCapTTM', $this->getSymbol()));

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
