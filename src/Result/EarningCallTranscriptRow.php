<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class EarningCallTranscriptRow extends FmpResult
{
	public const META_FIELDS = ['quarter', 'year', 'date'];

	public function getQuarter(): int
	{
		return ArrayTypeAssert::int($this->data, '0');
	}


	public function getYear(): int
	{
		return ArrayTypeAssert::int($this->data, '1');
	}


	public function getDate(): string
	{
		return ArrayTypeAssert::string($this->data, '2');
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
