<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Utility;

use LogicException;
use WebChemistry\Fmp\FmpClient;

final class DeduplicateTickers
{

	/**
	 * @param array<string> $priorities
	 */
	public function __construct(
		private FmpClient $client,
		private array $priorities = [],
	)
	{
	}

	/**
	 * @return array<string, string> [duplicated => original]
	 */
	public function deduplicate(): array
	{
		$list = $this->client->symbolList();
		$exchanges = [];

		foreach ($list->yieldObjects() as $item) {
			$exchanges[$item->getExchangeShortName()][] = [$item->getSymbol(), $item->getName(), $item->getType()];
		}

		$index = [];
		$duplicates = [];

		foreach ($this->priorities as $priority) {
			if (!isset($exchanges[$priority])) {
				throw new LogicException(sprintf('Exchange %s not found', $priority));
			}

			foreach ($exchanges[$priority] as [$symbol, $name, $type]) {
				if (isset($index[$name . '$$' . $type])) {
					$duplicates[$symbol] = $index[$name . '$$' . $type];
				} else {
					$index[$name . '$$' . $type] = $symbol;
				}
			}

			unset($exchanges[$priority]);
		}

		foreach ($exchanges as $exchange) {
			foreach ($exchange as [$symbol, $name, $type]) {
				if (isset($index[$name . '$$' . $type])) {
					$duplicates[$symbol] = $index[$name . '$$' . $type];
				}
			}
		}

		return $duplicates;
	}

}
