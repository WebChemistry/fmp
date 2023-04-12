<?php declare(strict_types = 1);

use Typertion\Php\ArrayTypeAssert;
use WebChemistry\Fmp\Result\HistoricalLine;
use WebChemistry\FmpGenerator\Configuration;

require __DIR__ . '/../vendor/autoload.php';

$holidays = [
	'New Years Day',
	'Martin Luther King, Jr. Day',
	'Washington\'s Birthday',
	'Good Friday',
	'Juneteenth National Independence Day',
	'Independence Day',
	'Labor Day',
	'Thanksgiving Day',
	'Christmas',
];

$generator = new \WebChemistry\FmpGenerator\Generator([
	(new Configuration('Quote', messageWithSymbol: true, containsSymbol: true, uses: [DateTime::class]))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('price', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), mayNotExist: true, zeroIsNull: true)
		->addProperty('range', 'string|null', ArrayTypeAssert::stringOrNull(...), mayNotExist: true)
		->addProperty('yearHigh', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), mayNotExist: true, zeroIsNull: true)
		->addProperty('yearLow', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), mayNotExist: true, zeroIsNull: true)
		->addProperty('change', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...))
		->addProperty('dayHigh', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('dayLow', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('previousClose', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('volume', 'int|null', ArrayTypeAssert::integerishOrNull(...), zeroIsNull: true)
		->addProperty('avgVolume', 'int|null', ArrayTypeAssert::integerishOrNull(...), zeroIsNull: true, fieldName: 'averageVolume')
		->addProperty('priceAvg50', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('priceAvg200', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('open', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('name', 'string|null', ArrayTypeAssert::stringOrNull(...))
		->addProperty('exchange', 'string|null', ArrayTypeAssert::stringOrNull(...), mayNotExist: true)
		->addProperty('changesPercentage', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), fieldName: 'percentageChange')
		->addProperty('sharesOutstanding', 'int|null', ArrayTypeAssert::integerishOrNull(...), zeroIsNull: true)
		->addProperty('timestamp', 'int|null', ArrayTypeAssert::intOrNull(...))
		->addProperty('marketCap', 'int|null', ArrayTypeAssert::integerishOrNull(...), zeroIsNull: true, fieldName: 'marketCapitalization')
		->addProperty('earningsAnnouncement', 'DateTime|null', ArrayTypeAssert::stringOrNull(...), converter: '$value = $this->dateTime($value);')
		->addProperty('eps', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('pe', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addCustomProperty('datetime', 'DateTime|null', [
			'return $this->dateTime($this->getTimestamp());',
		])
	,
	(new Configuration('Ratios', messageWithSymbol: true, containsSymbol: true, replacements: ['TTM' => '']))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('peRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('pegRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('payoutRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('currentRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('quickRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('cashRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('daysOfSalesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('daysOfInventoryOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingCycleTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('daysOfPayablesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('cashConversionCycleTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('grossProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('pretaxProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('netProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('effectiveTaxRateTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('returnOnAssetsTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('returnOnEquityTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('returnOnCapitalEmployedTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('netIncomePerEBTTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('ebtPerEbitTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('ebitPerRevenueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('debtRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('debtEquityRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('longTermDebtToCapitalizationTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('totalDebtToCapitalizationTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('interestCoverageTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('cashFlowToDebtRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('companyEquityMultiplierTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('receivablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('payablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('inventoryTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('fixedAssetTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('assetTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('freeCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('cashPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingCashFlowSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('freeCashFlowOperatingCashFlowRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('cashFlowCoverageRatiosTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('shortTermCoverageRatiosTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('capitalExpenditureCoverageRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('dividendPaidAndCapexCoverageRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceBookValueRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceToBookRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceToSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceEarningsRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceToFreeCashFlowsRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceToOperatingCashFlowsRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceCashFlowRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceEarningsToGrowthRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('dividendYieldTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('enterpriseValueMultipleTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceFairValueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('dividendPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
	,
	(new Configuration('KeyMetrics', messageWithSymbol: true, containsSymbol: true, replacements: ['TTM' => '']))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('revenuePerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('netIncomePerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('freeCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('cashPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('bookValuePerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('tangibleBookValuePerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('shareholdersEquityPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('interestDebtPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('marketCapTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('enterpriseValueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('peRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('priceToSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('pocfratioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('pfcfRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('pbRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('ptbRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('evToSalesTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('enterpriseValueOverEBITDATTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('evToOperatingCashFlowTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('evToFreeCashFlowTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('earningsYieldTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('freeCashFlowYieldTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('debtToEquityTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('debtToAssetsTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('netDebtToEBITDATTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('currentRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('interestCoverageTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('incomeQualityTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('dividendYieldTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('dividendYieldPercentageTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('payoutRatioTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('salesGeneralAndAdministrativeToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('researchAndDevelopementToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('intangiblesToTotalAssetsTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('capexToOperatingCashFlowTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('capexToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('capexToDepreciationTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('stockBasedCompensationToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('grahamNumberTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('roicTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('returnOnTangibleAssetsTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('grahamNetNetTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('workingCapitalTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('tangibleAssetValueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('netCurrentAssetValueTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('investedCapitalTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('averageReceivablesTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('averagePayablesTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('averageInventoryTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('daysSalesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('daysPayablesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('daysOfInventoryOnHandTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('receivablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('payablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('inventoryTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('roeTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('capexPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('dividendPerShareTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('debtToMarketCapTTM', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
	,
	(new Configuration('Score', messageWithSymbol: true, containsSymbol: true))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('altmanZScore', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('piotroskiScore', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('workingCapital', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('totalAssets', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('retainedEarnings', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('ebit', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('marketCap', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true, fieldName: 'maretCapitalization')
		->addProperty('totalLiabilities', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('revenue', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true),
	(new Configuration('StockPriceChange', messageWithSymbol: true, containsSymbol: true))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('1D', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('5D', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('1M', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('3M', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('6M', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('ytd', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('1Y', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('3Y', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('5Y', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('10Y', 'float|null', ArrayTypeAssert::floatishOrNull(...))
		->addProperty('max', 'float|null', ArrayTypeAssert::floatishOrNull(...)),
	(new Configuration('MarketOpen'))
		->addProperty('stockExchangeName', 'string', ArrayTypeAssert::string(...))
		->addProperty('stockMarketHours', 'array', ArrayTypeAssert::array(...), commentType: 'array{ openingHour: string, closingHour: string }')
		->addProperty('stockMarketHolidays', 'array', ArrayTypeAssert::array(...), commentType: 'array{ year: int, ' . createHolidays($holidays) . '}[]')
		->addProperty('isTheStockMarketOpen', 'bool', ArrayTypeAssert::bool(...))
		->addProperty('isTheEuronextMarketOpen', 'bool', ArrayTypeAssert::bool(...))
		->addProperty('isTheForexMarketOpen', 'bool', ArrayTypeAssert::bool(...))
		->addProperty('isTheCryptoMarketOpen', 'bool', ArrayTypeAssert::bool(...)),
]);

$generator->generate();

function convertToArray(string $className): string
{
	return implode("\n", [
		'$array = [];',
		'',
		'foreach ($value as $item) {',
		"\t" . sprintf('$array[] = new %s($item);', $className),
		'}',
		'',
		'$value = $array;',
	]);
}

/**
 * @param string[] $holidays
 */
function createHolidays(array $holidays): string
{
	return implode(', ', array_map(
		fn (string $name): string => sprintf("\"%s\": string|null", addslashes($name)),
		$holidays,
	));
}
