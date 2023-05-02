<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class GradeConsensus extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', 'strongBuy', 'buy', 'hold', 'sell', 'strongSell', 'consensus'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getStrongBuy(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'strongBuy', fn (): string => sprintf('%s of %s', 'strongBuy', $this->getSymbol()));
	}


	public function getBuy(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'buy', fn (): string => sprintf('%s of %s', 'buy', $this->getSymbol()));
	}


	public function getHold(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'hold', fn (): string => sprintf('%s of %s', 'hold', $this->getSymbol()));
	}


	public function getSell(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'sell', fn (): string => sprintf('%s of %s', 'sell', $this->getSymbol()));
	}


	public function getStrongSell(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'strongSell', fn (): string => sprintf('%s of %s', 'strongSell', $this->getSymbol()));
	}


	public function getConsensus(): Grade|null
	{
		if (($this->data['consensus'] ?? null) === '') {
			return null;
		}

		$value = ArrayTypeAssert::string($this->data, 'consensus', fn (): string => sprintf('%s of %s', 'consensus', $this->getSymbol()));

		$value = Grade::from($value);

		return $value;
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
