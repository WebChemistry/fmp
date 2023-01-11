<?php declare(strict_types = 1);

use Tester\Assert;
use WebChemistry\Fmp\FmpClient;
use WebChemistry\Fmp\Response\ObjectsResponse;

require __DIR__ . '/bootstrap.php';

$client = new FmpClient(getApiKey());

$responses = [
	$client->keyMetricsTtmBulk(),
	$client->ratiosTtmBulk(),
	$client->scores(),
	$client->quotes('NASDAQ'),
];

foreach ($responses as $response) {
	if ($response instanceof ObjectsResponse) {
		$reflection = new ReflectionClass($response->getClassName());

		$methods = [];

		foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method) {
			if ($method->getDeclaringClass()->name !== $reflection->name) {
				continue;
			}

			if (str_starts_with($method->name, '__')) {
				continue;
			}

			$methods[] = $method;
		}

		foreach ($response->yieldObjects() as $object) {
			foreach ($methods as $method) {
				Assert::$counter++;

				$method->invoke($object);
			}
		}
	}
}
