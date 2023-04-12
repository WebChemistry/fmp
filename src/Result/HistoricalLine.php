<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Result;

use DateTime;
use Typertion\Php\ArrayTypeAssert;

final class HistoricalLine extends FmpResult
{

	public function getDate(): DateTime
	{
		return new DateTime(sprintf('%s 00:00:00', $this->data['date']));
	}

	public function getClose(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'close');
	}

	protected function getFieldNames(): array
	{
		return ['date', 'close'];
	}

}
