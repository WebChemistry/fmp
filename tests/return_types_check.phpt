<?php declare(strict_types = 1);

use Tester\Assert;
use WebChemistry\Fmp\FmpClient;
use WebChemistry\Fmp\Response\ObjectsResponse;
use WebChemistry\Fmp\Result\FmpResult;

require __DIR__ . '/bootstrap.php';

$client = new FmpClient(getApiKey());

$responses = [
	$client->keyMetricsTtmBulk(),
	$client->ratiosTtmBulk(),
	$client->scores(),
	$client->quotes('NASDAQ'),
	$client->quotes('NYSE'),
	$client->quotes('AMEX'),
	$client->quotes('crypto'),
];

foreach ($responses as $response) {
	if ($response instanceof ObjectsResponse) {
		/** @var FmpResult $object */
		foreach ($response->yieldObjects() as $object) {
			Assert::$counter++;
			$object->getParsedData();
		}
	}
}
