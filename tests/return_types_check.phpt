<?php declare(strict_types = 1);

use Tester\Assert;
use Typertion\Php\Exception\AssertionFailedException;
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
	Assert::true($response instanceof ObjectsResponse);
	if ($response instanceof ObjectsResponse) {
		/** @var FmpResult $object */
		foreach ($response->yieldObjects() as $object) {
			Assert::$counter++;

			try {
				$object->getParsedData();
			} catch (AssertionFailedException $exception) {
				Assert::fail($exception->getMessage());
			}
		}
	}
}
