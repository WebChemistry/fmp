<?php declare(strict_types = 1);

use Nette\Utils\Json;
use Typertion\Php\ArrayTypeAssert;
use WebChemistry\Fmp\Result\Grade;
use WebChemistry\Fmp\Result\HistoricalLine;
use WebChemistry\Fmp\Utility\FmpConverter;
use WebChemistry\FmpGenerator\CommentType;
use WebChemistry\FmpGenerator\CommentTypeLocation;
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
		->addProperty('earningsAnnouncement', ...dateTimeField(true))
		->addProperty('eps', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addProperty('pe', 'int|float|null', ArrayTypeAssert::intOrFloatOrNull(...), zeroIsNull: true)
		->addCustomProperty('datetime', 'DateTime|null', [
			'return $this->dateTime($this->getTimestamp());',
		])
	,
	(new Configuration('Ratios', messageWithSymbol: true, containsSymbol: true, replacements: ['TTM' => '']))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('peRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('pegRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('payoutRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('currentRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('quickRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('cashRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('daysOfSalesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('daysOfInventoryOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('operatingCycleTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('daysOfPayablesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('cashConversionCycleTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('grossProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('operatingProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('pretaxProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('netProfitMarginTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('effectiveTaxRateTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('returnOnAssetsTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('returnOnEquityTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('returnOnCapitalEmployedTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('netIncomePerEBTTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('ebtPerEbitTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('ebitPerRevenueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('debtRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('debtEquityRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('longTermDebtToCapitalizationTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('totalDebtToCapitalizationTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('interestCoverageTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('cashFlowToDebtRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('companyEquityMultiplierTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('receivablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('payablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('inventoryTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('fixedAssetTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('assetTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('operatingCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('freeCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('cashPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('operatingCashFlowSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('freeCashFlowOperatingCashFlowRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('cashFlowCoverageRatiosTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('shortTermCoverageRatiosTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('capitalExpenditureCoverageRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('dividendPaidAndCapexCoverageRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceBookValueRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceToBookRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceToSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceEarningsRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceToFreeCashFlowsRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceToOperatingCashFlowsRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceCashFlowRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceEarningsToGrowthRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('dividendYieldTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('enterpriseValueMultipleTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceFairValueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('dividendPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
	,
	(new Configuration('KeyMetrics', messageWithSymbol: true, containsSymbol: true, replacements: ['TTM' => '']))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('revenuePerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('netIncomePerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('operatingCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('freeCashFlowPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('cashPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('bookValuePerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('tangibleBookValuePerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('shareholdersEquityPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('interestDebtPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('marketCapTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('enterpriseValueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('peRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('priceToSalesRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('pocfratioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('pfcfRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('pbRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('ptbRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('evToSalesTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('enterpriseValueOverEBITDATTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('evToOperatingCashFlowTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('evToFreeCashFlowTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('earningsYieldTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('freeCashFlowYieldTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('debtToEquityTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('debtToAssetsTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('netDebtToEBITDATTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('currentRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('interestCoverageTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('incomeQualityTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('dividendYieldTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('dividendYieldPercentageTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('payoutRatioTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('salesGeneralAndAdministrativeToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('researchAndDevelopementToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('intangiblesToTotalAssetsTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('capexToOperatingCashFlowTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('capexToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('capexToDepreciationTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('stockBasedCompensationToRevenueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('grahamNumberTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('roicTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('returnOnTangibleAssetsTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('grahamNetNetTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('workingCapitalTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('tangibleAssetValueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('netCurrentAssetValueTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('investedCapitalTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('averageReceivablesTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('averagePayablesTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('averageInventoryTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('daysSalesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('daysPayablesOutstandingTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('daysOfInventoryOnHandTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('receivablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('payablesTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('inventoryTurnoverTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('roeTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('capexPerShareTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
		->addProperty('debtToMarketCapTTM', 'float', ArrayTypeAssert::floatish(...), emptyIsNull: true)
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
	(new Configuration('HistoricalChartItem', uses: [DateTime::class]))
		->addProperty('date', ...dateTimeField())
		->addProperty('open', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('low', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('high', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('close', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('volume', 'int', ArrayTypeAssert::int(...)),
	(new Configuration('GradeConsensus', messageWithSymbol: true, containsSymbol: true, uses: [Grade::class]))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('strongBuy', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('buy', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('hold', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('sell', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('strongSell', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('consensus', implode('|', [Grade::class, 'null']), ArrayTypeAssert::string(...), emptyIsNull: true, converter: enumConverter('Grade')),
	(new Configuration('PriceTarget', messageWithSymbol: true, containsSymbol: true))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('lastMonth', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastMonthAvgPT', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastMonthAvgPTPercentDif', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastQuarter', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastQuarterAvgPT', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastQuarterAvgPTPercentDif', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastYear', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastYearAvgPT', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('lastYearAvgPTPercentDif', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('allTime', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('allTimeAvgPT', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('allTimeAvgPTPercentDif', 'float', ArrayTypeAssert::floatish(...))
		->addProperty('publishers', 'array', ArrayTypeAssert::string(...), commentType: new CommentType('array<string>', CommentTypeLocation::Method),
			converter: '$value = array_map(fn (string $v): string => substr($v, 1, -1), explode(\', \', substr($value, 1, -1)));'),
	(new Configuration('Profile', messageWithSymbol: true, containsSymbol: true, uses: [FmpConverter::class]))
		->addProperty('Symbol', 'string', ArrayTypeAssert::string(...), fieldName: 'symbol')
		->addProperty('Price', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, emptyIsNull: true, fieldName: 'price')
		->addProperty('Beta', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, fieldName: 'beta')
		->addProperty('VolAvg', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, fieldName: 'volAvg')
		->addProperty('MktCap', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, fieldName: 'mktCap')
		->addProperty('LastDiv', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, fieldName: 'lastDiv')
		->addProperty('Range', 'string', ArrayTypeAssert::string(...), emptyIsNull: true, fieldName: 'range')
		->addProperty('Changes', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, emptyIsNull: true, fieldName: 'changes')
		->addProperty('companyName', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('currency', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('cik', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('isin', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('cusip', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('exchange', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('exchangeShortName', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('industry', 'string', ArrayTypeAssert::string(...), emptyIsNull: true, converter: '$value = FmpConverter::convertIndustry($value);')
		->addProperty('website', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('description', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('CEO', 'string', ArrayTypeAssert::string(...), emptyIsNull: true, fieldName: 'ceo')
		->addProperty('sector', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('country', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('fullTimeEmployees', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, emptyIsNull: true)
		->addProperty('phone', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('address', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('city', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('state', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('zip', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('DCF_diff', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, emptyIsNull: true, fieldName: 'dcfDiff')
		->addProperty('DCF', 'string', ArrayTypeAssert::string(...), zeroIsNull: true, fieldName: 'dcf')
		->addProperty('image', 'string', ArrayTypeAssert::string(...))
		->addProperty('ipoDate', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('defaultImage', 'string', ArrayTypeAssert::string(...))
		->addProperty('isEtf', 'string', ArrayTypeAssert::string(...))
		->addProperty('isActivelyTrading', 'string', ArrayTypeAssert::string(...))
		->addProperty('isFund', 'string', ArrayTypeAssert::string(...))
		->addProperty('isAdr', 'string', ArrayTypeAssert::string(...)),
	(new Configuration('IncomeStatement', messageWithSymbol: true, containsSymbol: true))
		->addProperty('date', 'string', ArrayTypeAssert::string(...))
		->addProperty('symbol', 'string', ArrayTypeAssert::string(...))
		->addProperty('reportedCurrency', 'string', ArrayTypeAssert::string(...))
		->addProperty('cik', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('fillingDate', 'string', ArrayTypeAssert::string(...))
		->addProperty('acceptedDate', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('calendarYear', 'int', ArrayTypeAssert::integerish(...))
		->addProperty('period', 'string', ArrayTypeAssert::string(...))
		->addProperty('revenue', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('costOfRevenue', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('grossProfit', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('grossProfitRatio', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('ResearchAndDevelopmentExpenses', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true, fieldName: 'researchAndDevelopmentExpenses')
		->addProperty('GeneralAndAdministrativeExpenses', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true, fieldName: 'generalAndAdministrativeExpenses')
		->addProperty('SellingAndMarketingExpenses', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true, fieldName: 'sellingAndMarketingExpenses')
		->addProperty('SellingGeneralAndAdministrativeExpenses', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true, fieldName: 'sellingGeneralAndAdministrativeExpenses')
		->addProperty('otherExpenses', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingExpenses', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('costAndExpenses', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('interestExpense', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('depreciationAndAmortization', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('EBITDA', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('EBITDARatio', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingIncome', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('operatingIncomeRatio', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('totalOtherIncomeExpensesNet', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('incomeBeforeTax', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('incomeBeforeTaxRatio', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('incomeTaxExpense', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('netIncome', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('netIncomeRatio', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('EPS', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('EPSDiluted', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('weightedAverageShsOut', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('weightedAverageShsOutDil', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
		->addProperty('link', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('finalLink', 'string', ArrayTypeAssert::string(...), emptyIsNull: true)
		->addProperty('interestIncome', 'float', ArrayTypeAssert::floatish(...), zeroIsNull: true)
	,
]);

$generator->generate();

function enumConverter(string $enumClass): string
{
	return sprintf('$value = %s::from($value);', $enumClass);
}

function dateTimeField(bool $nullable = false): array
{
	return [
		'DateTime' . ($nullable ? '|null' : ''),
		$nullable ? ArrayTypeAssert::stringOrNull(...) : ArrayTypeAssert::string(...),
		'converter' => '$value = $this->dateTime($value);',
	];
}

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
