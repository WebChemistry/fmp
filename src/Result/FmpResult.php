<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Result;

use DateTime;
use DateTimeInterface;
use Exception;
use Nette\Utils\Floats;

abstract class FmpResult
{

	/**
	 * @param mixed[] $data
	 */
	public function __construct(
		protected readonly array $data,
	)
	{
	}

	/**
	 * @return mixed[]
	 */
	public function getRawData(): array
	{
		return $this->data;
	}

	/**
	 * @return array<string, mixed>
	 */
	public function getParsedData(): array
	{
		$values = [];

		foreach ($this->getFieldNames() as $fieldName) {
			$getter = sprintf('get%s', ucfirst($fieldName));

			$values[$fieldName] = $this->$getter();
		}

		return $values;
	}

	protected function isZero(mixed $value): bool
	{
		if (!is_int($value) && !is_float($value)) {
			return false;
		}

		return $value === 0 || Floats::isZero($value);
	}

	protected function dateTime(mixed $value, bool $throw = true): ?DateTime
	{
		if (is_int($value)) {
			$value = sprintf('@%d', $value);
		}

		if (is_string($value)) {
			try {
				return new DateTime($value);
			} catch (Exception $exception) {
				if ($throw) {
					throw $exception;
				}

				return null;
			}
		}

		return null;
	}

	/**
	 * @return string[]
	 */
	abstract protected function getFieldNames(): array;

}
