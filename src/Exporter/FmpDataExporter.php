<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Exporter;

use LogicException;
use OutOfBoundsException;
use WebChemistry\Fmp\Response\ChildrenResponse;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Result\SymbolResult;
use WebChemistry\Fmp\Utility\FmpResultUtility;

final class FmpDataExporter
{

	/**
	 * @template T of FmpResult
	 * @param ChildrenResponse<T> $response
	 * @param string[] $mapping
	 * @param string[] $symbols
	 * @return list<mixed[]>
	 */
	public function exportChildren(ChildrenResponse $response, array $mapping = [], array $symbols = []): array
	{
		$symbolIndex = $this->createSymbolIndex($symbols);
		$mapping = $this->processMapping(
			$response->getClassName(),
			$mapping,
			FmpResultUtility::getFields($response->getClassName()),
		);
		$return = [];

		/** @var FmpResult $object */
		foreach ($response->yieldObjects() as $object) {
			if ($symbolIndex) {
				if (!$object instanceof SymbolResult) {
					throw new LogicException(
						sprintf('Object %s did not implement %s interface.', $object::class, SymbolResult::class)
					);
				}

				if (!isset($symbolIndex[$object->getSymbol()])) {
					continue;
				}
			}

			if ($mapping) {
				$parsed = $object->getParsedData();
				$values = [];

				foreach ($mapping as $fieldName => $columnName) {
					$values[$columnName] = $parsed[$fieldName];
				}

			} else {
				$values = $object->getParsedData();
			}

			$return[] = $values;
		}

		return $return;
	}

	/**
	 * @param class-string $className
	 * @param string[] $mapping
	 * @param string[] $fields
	 * @return array<string, string> fieldName => columnName
	 */
	private function processMapping(string $className, array $mapping, array $fields): array
	{
		if (!$mapping) {
			return array_combine($fields, $fields);
		}

		$return = [];

		foreach ($mapping as $fieldName => $columnName) {
			if (is_int($fieldName)) {
				$return[$columnName] = $columnName;

				if (!in_array($columnName, $fields, true)) {
					throw new OutOfBoundsException(sprintf('Field %s does not exist in %s', $columnName, $className));
				}

				continue;
			}

			$return[$fieldName] = $columnName;

			if (!in_array($fieldName, $fields, true)) {
				throw new OutOfBoundsException(sprintf('Field %s does not exist in %s', $fieldName, $className));
			}
		}

		return $return;
	}

	/**
	 * @param string[] $symbols
	 * @return array<string, true>
	 */
	private function createSymbolIndex(array $symbols): array
	{
		$index = [];

		foreach ($symbols as $symbol) {
			$index[$symbol] = true;
		}

		return $index;
	}

}
