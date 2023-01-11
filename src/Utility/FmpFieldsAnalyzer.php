<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Utility;

use LogicException;
use Stringable;
use WebChemistry\Fmp\Response\ChildrenResponse;
use WebChemistry\Fmp\Result\FmpResult;

final class FmpFieldsAnalyzer
{

	/**
	 * @param ChildrenResponse<FmpResult> $response
	 * @return array{length: int|null, precision: int|null, scale: int|null, max: int|float|null, min: int|float|null, types: string[]}[]
	 */
	public static function analyze(ChildrenResponse $response, int $epsilon = 10): array
	{
		$fields = [];
		$maxScales = [];

		foreach ($response->yieldObjects() as $object) {
			$data = $object->getParsedData();

			foreach ($data as $fieldName => $value) {
				$fields[$fieldName] ??= [
					'length' => null,
					'precision' => null,
					'scale' => null,
					'max' => null,
					'min' => null,
					'maxScale' => null,
					'types' => [],
				];

				$ref = &$fields[$fieldName];
				$ref['types'][$type = get_debug_type($value)] = $type;

				if (is_int($value)) {
					self::set($ref, 'length', strlen((string) $value));
					self::set($ref, 'max', $value);
				} else if (is_float($value)) {
					$formatted = rtrim(number_format($value, $epsilon), '0');
					$precision = strpos($formatted, '.');

					if ($precision === false) {
						throw new LogicException('Unexpected error.');
					}

					$scale = strlen($formatted) - 1 - $precision;

					self::set($ref, 'precision', $precision);
					self::set($ref, 'scale', $scale);
					self::set($ref, 'length', $precision + $scale + ($scale === 0 ? 0 : 1));

					$ref['max'] = max((float) $ref['max'], $value);
					$ref['min'] = min((float) $ref['min'], $value);

					if (($maxScales[$fieldName] ?? -1) < $scale) {
						$maxScales[$fieldName] = $scale;
						$ref['maxScale'] = $value;
					}
				} else if (is_string($value)) {
					self::set($ref, 'length', strlen($value));
				} else if (is_bool($value)) {
					self::set($ref, 'length', 1);
				} else if ($value instanceof Stringable) {
					self::set($ref, 'length', strlen((string) $value));
				}
			}
		}

		return $fields;
	}

	/**
	 * @param ChildrenResponse<FmpResult> $response
	 */
	public static function stringifyAnalyze(ChildrenResponse $response, int $epsilon = 10, bool $detail = false): string
	{
		$buffer = '';

		foreach (self::analyze($response, $epsilon) as $fieldName => $result) {
			$buffer .= sprintf('%s (%s) => ', $fieldName, implode(', ', $result['types']));

			unset($result['types']);

			if (!$detail) {
				foreach (['maxScale', 'min', 'max'] as $delete) {
					unset($result[$delete]);
				}
			}

			$buffer .= self::implodeKeys(
					array_map(
						fn (int|float|null $val): string =>
						is_float($val) ? rtrim(rtrim(number_format($val, $epsilon, thousands_separator: ' '), '0'), '.') : (string) $val,
						array_filter($result, fn (int|float|null $val) => $val !== null),
					),
					', ',
					': ',
				) . "\n";
		}

		return substr($buffer, 0, -1);
	}

	/**
	 * @param string[] $array
	 */
	private static function implodeKeys(array $array, string $separator, string $keySeparator): string
	{
		$buffer = '';

		foreach ($array as $key => $value) {
			$buffer .= $key . $keySeparator . $value . $separator;
		}

		return substr($buffer, 0, -strlen($separator));
	}

	/**
	 * @param array{length: int|null, precision: int|null, scale: int|null, max: int|null} $ref
	 * @phpstan-param 'length'|'precision'|'scale'|'max' $key
	 */
	private static function set(array &$ref, string $key, int $value): void
	{
		$ref[$key] = max((int) $ref[$key], $value);
	}

}
