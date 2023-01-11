<?php declare(strict_types = 1);

use WebChemistry\Fmp\FmpClient;
use WebChemistry\Fmp\Importer\DataImporter;

require __DIR__ . '/bootstrap.php';

$client = new FmpClient(getApiKey());

$importer = new DataImporter();

echo $importer->generateSql('tableName', $client->stockPriceChange('AAPL'), ['symbol', '1D' => 'day']);
