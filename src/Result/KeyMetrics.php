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
		'debtToMarketCap',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getRevenuePerShare(): float|null
	{
		if (($this->data['revenuePerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'revenuePerShareTTM', fn (): string => sprintf('%s of %s', 'revenuePerShareTTM', $this->getSymbol()));
	}


	public function getNetIncomePerShare(): float|null
	{
		if (($this->data['netIncomePerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'netIncomePerShareTTM', fn (): string => sprintf('%s of %s', 'netIncomePerShareTTM', $this->getSymbol()));
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


	public function getBookValuePerShare(): float|null
	{
		if (($this->data['bookValuePerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'bookValuePerShareTTM', fn (): string => sprintf('%s of %s', 'bookValuePerShareTTM', $this->getSymbol()));
	}


	public function getTangibleBookValuePerShare(): float|null
	{
		if (($this->data['tangibleBookValuePerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'tangibleBookValuePerShareTTM', fn (): string => sprintf('%s of %s', 'tangibleBookValuePerShareTTM', $this->getSymbol()));
	}


	public function getShareholdersEquityPerShare(): float|null
	{
		if (($this->data['shareholdersEquityPerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'shareholdersEquityPerShareTTM', fn (): string => sprintf('%s of %s', 'shareholdersEquityPerShareTTM', $this->getSymbol()));
	}


	public function getInterestDebtPerShare(): float|null
	{
		if (($this->data['interestDebtPerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'interestDebtPerShareTTM', fn (): string => sprintf('%s of %s', 'interestDebtPerShareTTM', $this->getSymbol()));
	}


	public function getMarketCap(): float|null
	{
		if (($this->data['marketCapTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'marketCapTTM', fn (): string => sprintf('%s of %s', 'marketCapTTM', $this->getSymbol()));
	}


	public function getEnterpriseValue(): float|null
	{
		if (($this->data['enterpriseValueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'enterpriseValueTTM', fn (): string => sprintf('%s of %s', 'enterpriseValueTTM', $this->getSymbol()));
	}


	public function getPeRatio(): float|null
	{
		if (($this->data['peRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'peRatioTTM', fn (): string => sprintf('%s of %s', 'peRatioTTM', $this->getSymbol()));
	}


	public function getPriceToSalesRatio(): float|null
	{
		if (($this->data['priceToSalesRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'priceToSalesRatioTTM', fn (): string => sprintf('%s of %s', 'priceToSalesRatioTTM', $this->getSymbol()));
	}


	public function getPocfratio(): float|null
	{
		if (($this->data['pocfratioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'pocfratioTTM', fn (): string => sprintf('%s of %s', 'pocfratioTTM', $this->getSymbol()));
	}


	public function getPfcfRatio(): float|null
	{
		if (($this->data['pfcfRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'pfcfRatioTTM', fn (): string => sprintf('%s of %s', 'pfcfRatioTTM', $this->getSymbol()));
	}


	public function getPbRatio(): float|null
	{
		if (($this->data['pbRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'pbRatioTTM', fn (): string => sprintf('%s of %s', 'pbRatioTTM', $this->getSymbol()));
	}


	public function getPtbRatio(): float|null
	{
		if (($this->data['ptbRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'ptbRatioTTM', fn (): string => sprintf('%s of %s', 'ptbRatioTTM', $this->getSymbol()));
	}


	public function getEvToSales(): float|null
	{
		if (($this->data['evToSalesTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'evToSalesTTM', fn (): string => sprintf('%s of %s', 'evToSalesTTM', $this->getSymbol()));
	}


	public function getEnterpriseValueOverEBITDA(): float|null
	{
		if (($this->data['enterpriseValueOverEBITDATTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'enterpriseValueOverEBITDATTM', fn (): string => sprintf('%s of %s', 'enterpriseValueOverEBITDATTM', $this->getSymbol()));
	}


	public function getEvToOperatingCashFlow(): float|null
	{
		if (($this->data['evToOperatingCashFlowTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'evToOperatingCashFlowTTM', fn (): string => sprintf('%s of %s', 'evToOperatingCashFlowTTM', $this->getSymbol()));
	}


	public function getEvToFreeCashFlow(): float|null
	{
		if (($this->data['evToFreeCashFlowTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'evToFreeCashFlowTTM', fn (): string => sprintf('%s of %s', 'evToFreeCashFlowTTM', $this->getSymbol()));
	}


	public function getEarningsYield(): float|null
	{
		if (($this->data['earningsYieldTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'earningsYieldTTM', fn (): string => sprintf('%s of %s', 'earningsYieldTTM', $this->getSymbol()));
	}


	public function getFreeCashFlowYield(): float|null
	{
		if (($this->data['freeCashFlowYieldTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'freeCashFlowYieldTTM', fn (): string => sprintf('%s of %s', 'freeCashFlowYieldTTM', $this->getSymbol()));
	}


	public function getDebtToEquity(): float|null
	{
		if (($this->data['debtToEquityTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'debtToEquityTTM', fn (): string => sprintf('%s of %s', 'debtToEquityTTM', $this->getSymbol()));
	}


	public function getDebtToAssets(): float|null
	{
		if (($this->data['debtToAssetsTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'debtToAssetsTTM', fn (): string => sprintf('%s of %s', 'debtToAssetsTTM', $this->getSymbol()));
	}


	public function getNetDebtToEBITDA(): float|null
	{
		if (($this->data['netDebtToEBITDATTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'netDebtToEBITDATTM', fn (): string => sprintf('%s of %s', 'netDebtToEBITDATTM', $this->getSymbol()));
	}


	public function getCurrentRatio(): float|null
	{
		if (($this->data['currentRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'currentRatioTTM', fn (): string => sprintf('%s of %s', 'currentRatioTTM', $this->getSymbol()));
	}


	public function getInterestCoverage(): float|null
	{
		if (($this->data['interestCoverageTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'interestCoverageTTM', fn (): string => sprintf('%s of %s', 'interestCoverageTTM', $this->getSymbol()));
	}


	public function getIncomeQuality(): float|null
	{
		if (($this->data['incomeQualityTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'incomeQualityTTM', fn (): string => sprintf('%s of %s', 'incomeQualityTTM', $this->getSymbol()));
	}


	public function getDividendYield(): float|null
	{
		if (($this->data['dividendYieldTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'dividendYieldTTM', fn (): string => sprintf('%s of %s', 'dividendYieldTTM', $this->getSymbol()));
	}


	public function getDividendYieldPercentage(): float|null
	{
		if (($this->data['dividendYieldPercentageTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'dividendYieldPercentageTTM', fn (): string => sprintf('%s of %s', 'dividendYieldPercentageTTM', $this->getSymbol()));
	}


	public function getPayoutRatio(): float|null
	{
		if (($this->data['payoutRatioTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'payoutRatioTTM', fn (): string => sprintf('%s of %s', 'payoutRatioTTM', $this->getSymbol()));
	}


	public function getSalesGeneralAndAdministrativeToRevenue(): float|null
	{
		if (($this->data['salesGeneralAndAdministrativeToRevenueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'salesGeneralAndAdministrativeToRevenueTTM', fn (): string => sprintf('%s of %s', 'salesGeneralAndAdministrativeToRevenueTTM', $this->getSymbol()));
	}


	public function getResearchAndDevelopementToRevenue(): float|null
	{
		if (($this->data['researchAndDevelopementToRevenueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'researchAndDevelopementToRevenueTTM', fn (): string => sprintf('%s of %s', 'researchAndDevelopementToRevenueTTM', $this->getSymbol()));
	}


	public function getIntangiblesToTotalAssets(): float|null
	{
		if (($this->data['intangiblesToTotalAssetsTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'intangiblesToTotalAssetsTTM', fn (): string => sprintf('%s of %s', 'intangiblesToTotalAssetsTTM', $this->getSymbol()));
	}


	public function getCapexToOperatingCashFlow(): float|null
	{
		if (($this->data['capexToOperatingCashFlowTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'capexToOperatingCashFlowTTM', fn (): string => sprintf('%s of %s', 'capexToOperatingCashFlowTTM', $this->getSymbol()));
	}


	public function getCapexToRevenue(): float|null
	{
		if (($this->data['capexToRevenueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'capexToRevenueTTM', fn (): string => sprintf('%s of %s', 'capexToRevenueTTM', $this->getSymbol()));
	}


	public function getCapexToDepreciation(): float|null
	{
		if (($this->data['capexToDepreciationTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'capexToDepreciationTTM', fn (): string => sprintf('%s of %s', 'capexToDepreciationTTM', $this->getSymbol()));
	}


	public function getStockBasedCompensationToRevenue(): float|null
	{
		if (($this->data['stockBasedCompensationToRevenueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'stockBasedCompensationToRevenueTTM', fn (): string => sprintf('%s of %s', 'stockBasedCompensationToRevenueTTM', $this->getSymbol()));
	}


	public function getGrahamNumber(): float|null
	{
		if (($this->data['grahamNumberTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'grahamNumberTTM', fn (): string => sprintf('%s of %s', 'grahamNumberTTM', $this->getSymbol()));
	}


	public function getRoic(): float|null
	{
		if (($this->data['roicTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'roicTTM', fn (): string => sprintf('%s of %s', 'roicTTM', $this->getSymbol()));
	}


	public function getReturnOnTangibleAssets(): float|null
	{
		if (($this->data['returnOnTangibleAssetsTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'returnOnTangibleAssetsTTM', fn (): string => sprintf('%s of %s', 'returnOnTangibleAssetsTTM', $this->getSymbol()));
	}


	public function getGrahamNetNet(): float|null
	{
		if (($this->data['grahamNetNetTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'grahamNetNetTTM', fn (): string => sprintf('%s of %s', 'grahamNetNetTTM', $this->getSymbol()));
	}


	public function getWorkingCapital(): float|null
	{
		if (($this->data['workingCapitalTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'workingCapitalTTM', fn (): string => sprintf('%s of %s', 'workingCapitalTTM', $this->getSymbol()));
	}


	public function getTangibleAssetValue(): float|null
	{
		if (($this->data['tangibleAssetValueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'tangibleAssetValueTTM', fn (): string => sprintf('%s of %s', 'tangibleAssetValueTTM', $this->getSymbol()));
	}


	public function getNetCurrentAssetValue(): float|null
	{
		if (($this->data['netCurrentAssetValueTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'netCurrentAssetValueTTM', fn (): string => sprintf('%s of %s', 'netCurrentAssetValueTTM', $this->getSymbol()));
	}


	public function getInvestedCapital(): float|null
	{
		if (($this->data['investedCapitalTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'investedCapitalTTM', fn (): string => sprintf('%s of %s', 'investedCapitalTTM', $this->getSymbol()));
	}


	public function getAverageReceivables(): float|null
	{
		if (($this->data['averageReceivablesTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'averageReceivablesTTM', fn (): string => sprintf('%s of %s', 'averageReceivablesTTM', $this->getSymbol()));
	}


	public function getAveragePayables(): float|null
	{
		if (($this->data['averagePayablesTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'averagePayablesTTM', fn (): string => sprintf('%s of %s', 'averagePayablesTTM', $this->getSymbol()));
	}


	public function getAverageInventory(): float|null
	{
		if (($this->data['averageInventoryTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'averageInventoryTTM', fn (): string => sprintf('%s of %s', 'averageInventoryTTM', $this->getSymbol()));
	}


	public function getDaysSalesOutstanding(): float|null
	{
		if (($this->data['daysSalesOutstandingTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'daysSalesOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysSalesOutstandingTTM', $this->getSymbol()));
	}


	public function getDaysPayablesOutstanding(): float|null
	{
		if (($this->data['daysPayablesOutstandingTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'daysPayablesOutstandingTTM', fn (): string => sprintf('%s of %s', 'daysPayablesOutstandingTTM', $this->getSymbol()));
	}


	public function getDaysOfInventoryOnHand(): float|null
	{
		if (($this->data['daysOfInventoryOnHandTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'daysOfInventoryOnHandTTM', fn (): string => sprintf('%s of %s', 'daysOfInventoryOnHandTTM', $this->getSymbol()));
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


	public function getRoe(): float|null
	{
		if (($this->data['roeTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'roeTTM', fn (): string => sprintf('%s of %s', 'roeTTM', $this->getSymbol()));
	}


	public function getCapexPerShare(): float|null
	{
		if (($this->data['capexPerShareTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'capexPerShareTTM', fn (): string => sprintf('%s of %s', 'capexPerShareTTM', $this->getSymbol()));
	}


	public function getDebtToMarketCap(): float|null
	{
		if (($this->data['debtToMarketCapTTM'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'debtToMarketCapTTM', fn (): string => sprintf('%s of %s', 'debtToMarketCapTTM', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
