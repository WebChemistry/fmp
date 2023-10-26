<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class PriceTargetConsensus extends FmpResult
{
	public const META_FIELDS = ['symbol', 'targetHigh', 'targetLow', 'targetConsensus', 'targetMedian'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getTargetHigh(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetHigh');
	}


	public function getTargetLow(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetLow');
	}


	public function getTargetConsensus(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetConsensus');
	}


	public function getTargetMedian(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetMedian');
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
