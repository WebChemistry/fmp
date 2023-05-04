<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Result;

use DateTime;
use DateTimeZone;
use Exception;
use Nette\Utils\Floats;
use OutOfBoundsException;
use Typertion\Php\TypeAssert;

abstract class FmpResult
{

	private static DateTimeZone $dateTimeZone;

	/**
	 * @param mixed[] $data
	 * @param mixed[] $options
	 */
	public function __construct(
		protected readonly array $data,
		protected readonly array $options = [],
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

	public function getSingleParsedData(string $field): mixed
	{
		if (!in_array($field, $this->getFieldNames(), true)) {
			throw new OutOfBoundsException(sprintf('Field %s does not exist.', $field));
		}

		$getter = sprintf('get%s', ucfirst($field));

		return $this->$getter();
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
			if (isset($this->options['timeZone'])) {
				$value = date('Y-m-d H:i:s', $value);
			} else {
				$value = sprintf('@%d', $value);
			}
		}

		if (is_string($value)) {
			$timezone = self::getDateTimeZone();

			try {
				$dateTime = new DateTime(
					$value,
					TypeAssert::instanceOfOrNull($this->options['timeZone'] ?? null, DateTimeZone::class),
				);
				$dateTime->setTimezone($timezone);

				return $dateTime;
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

	private static function getDateTimeZone(): DateTimeZone
	{
		return self::$dateTimeZone ??= new DateTimeZone(date_default_timezone_get());
	}

}
