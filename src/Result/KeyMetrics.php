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
		$value = ArrayTypeAssert::floatish($this->data, 'revenuePerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetIncomePerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netIncomePerShareTTM', fn (): string => $this->getSymbol());

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


	public function getBookValuePerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'bookValuePerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTangibleBookValuePerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'tangibleBookValuePerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getShareholdersEquityPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'shareholdersEquityPerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInterestDebtPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestDebtPerShareTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getMarketCap(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'marketCapTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEnterpriseValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'enterpriseValueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPeRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'peRatioTTM', fn (): string => $this->getSymbol());

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


	public function getPocfratio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pocfratioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPfcfRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pfcfRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPbRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'pbRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPtbRatio(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'ptbRatioTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEvToSales(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'evToSalesTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEnterpriseValueOverEBITDA(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'enterpriseValueOverEBITDATTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEvToOperatingCashFlow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'evToOperatingCashFlowTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEvToFreeCashFlow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'evToFreeCashFlowTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEarningsYield(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'earningsYieldTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getFreeCashFlowYield(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'freeCashFlowYieldTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtToEquity(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtToEquityTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDebtToAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtToAssetsTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetDebtToEBITDA(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netDebtToEBITDATTM', fn (): string => $this->getSymbol());

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


	public function getInterestCoverage(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'interestCoverageTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getIncomeQuality(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'incomeQualityTTM', fn (): string => $this->getSymbol());

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


	public function getDividendYieldPercentage(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'dividendYieldPercentageTTM', fn (): string => $this->getSymbol());

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


	public function getSalesGeneralAndAdministrativeToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'salesGeneralAndAdministrativeToRevenueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getResearchAndDevelopementToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'researchAndDevelopementToRevenueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getIntangiblesToTotalAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'intangiblesToTotalAssetsTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexToOperatingCashFlow(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexToOperatingCashFlowTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexToRevenueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexToDepreciation(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexToDepreciationTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getStockBasedCompensationToRevenue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'stockBasedCompensationToRevenueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrahamNumber(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grahamNumberTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getRoic(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'roicTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getReturnOnTangibleAssets(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'returnOnTangibleAssetsTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getGrahamNetNet(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'grahamNetNetTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getWorkingCapital(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'workingCapitalTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTangibleAssetValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'tangibleAssetValueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getNetCurrentAssetValue(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'netCurrentAssetValueTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getInvestedCapital(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'investedCapitalTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAverageReceivables(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'averageReceivablesTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAveragePayables(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'averagePayablesTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAverageInventory(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'averageInventoryTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysSalesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysSalesOutstandingTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysPayablesOutstanding(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysPayablesOutstandingTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDaysOfInventoryOnHand(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'daysOfInventoryOnHandTTM', fn (): string => $this->getSymbol());

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


	public function getRoe(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'roeTTM', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCapexPerShare(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'capexPerShareTTM', fn (): string => $this->getSymbol());

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


	public function getDebtToMarketCap(): float|null
	{
		$value = ArrayTypeAssert::floatish($this->data, 'debtToMarketCapTTM', fn (): string => $this->getSymbol());

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
