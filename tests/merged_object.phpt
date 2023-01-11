<?php declare(strict_types = 1);

use Tester\Assert;
use WebChemistry\Fmp\FmpClient;
use WebChemistry\Fmp\Result\StockPriceChange;

require __DIR__ . '/bootstrap.php';

$client = new FmpClient(getApiKey());

$merged = $client->mergeObjects(
	StockPriceChange::class,
	[$client->stockPriceChange('AAPL'), $client->stockPriceChange('TSLA')]
);

Assert::same(2, $merged->count());
Assert::same(['AAPL', 'TSLA'], $merged->getSymbols());
Assert::count(2, $merged->toObjects());
Assert::same(StockPriceChange::class, get_class($merged->createIndex()->get('AAPL')));
