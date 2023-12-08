<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class PriceTargetConsensus extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', 'targetHigh', 'targetLow', 'targetConsensus', 'targetMedian'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getTargetHigh(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetHigh', fn (): string => sprintf('%s of %s', 'targetHigh', $this->getSymbol()));
	}


	public function getTargetLow(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetLow', fn (): string => sprintf('%s of %s', 'targetLow', $this->getSymbol()));
	}


	public function getTargetConsensus(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetConsensus', fn (): string => sprintf('%s of %s', 'targetConsensus', $this->getSymbol()));
	}


	public function getTargetMedian(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'targetMedian', fn (): string => sprintf('%s of %s', 'targetMedian', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
