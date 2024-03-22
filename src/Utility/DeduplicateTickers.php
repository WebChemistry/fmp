<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Utility;

use LogicException;
use WebChemistry\Fmp\FmpClient;

final class DeduplicateTickers
{

	private const Delimiter = '$$';

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
	public function deduplicate(bool $recursionGuard = true): array
	{
		$list = $this->client->symbolList();
		$exchanges = [];

		foreach ($list->yieldObjects() as $item) {
			$name = $item->getName();

			if (!is_string($name)) {
				continue;
			}

			$exchanges[$item->getExchangeShortName()][] = [$item->getSymbol(), $this->normalizeName($name), $item->getType()];
		}

		$index = [];
		$duplicates = [];

		foreach ($this->priorities as $priority) {
			if (!isset($exchanges[$priority])) {
				throw new LogicException(sprintf('Exchange %s not found', $priority));
			}

			$candidateIndex = [];

			foreach ($exchanges[$priority] as [$symbol, $name, $type]) {
				$key = $name . self::Delimiter . $type;

				// If the key is already in the index, it means that the symbol is a duplicate
				if (isset($index[$key])) {
					$duplicates[$symbol] = $index[$key];

					continue;
				}

				if (!isset($candidateIndex[$key])) {
					$candidateIndex[$key] = [];
				}

				$candidateIndex[$key][] = $symbol;
			}

			foreach ($candidateIndex as $key => $candidates) {
				$candidates = array_unique($candidates);

				if (count($candidates) === 1) {
					$index[$key] = $candidates[0];

					continue;
				}

				usort($candidates, $this->arraySort(...));

				$candidates = array_values($candidates);

				$index[$key] = $master = array_shift($candidates);

				foreach ($candidates as $slave) {
					$duplicates[$slave] = $master;
				}
			}

			unset($exchanges[$priority]);
		}

		foreach ($exchanges as $exchange) {
			foreach ($exchange as [$symbol, $name, $type]) {
				if (isset($index[$name . self::Delimiter . $type])) {
					$duplicates[$symbol] = $index[$name . self::Delimiter . $type];
				}
			}
		}

		if ($recursionGuard) {
			$this->recursionGuard($duplicates);
		}

		return $duplicates;
	}

	private function normalizeName(string $name): string
	{
		$replace = preg_replace('/\s+/', ' ', $name);

		if (!is_string($replace)) {
			return $name;
		}

		return str_replace(['.', ',', '&'], '', trim($replace));
	}

	private function arraySort(string $a, string $b): int
	{
		$lengthComparison = strlen($a) - strlen($b);

		if ($lengthComparison === 0) {
			return strcmp($a, $b);
		}

		return $lengthComparison;
	}

	/**
	 * @param array<string, string> $duplicates
	 */
	private function recursionGuard(array $duplicates): void
	{
		foreach ($duplicates as $key => $slave) {
			if (isset($duplicates[$slave])) {
				throw new LogicException(sprintf('Recursion detected for %s and %s', $key, $slave));
			}
		}
	}

}
