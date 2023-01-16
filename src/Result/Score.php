<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class Score extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'altmanZScore',
		'piotroskiScore',
		'workingCapital',
		'totalAssets',
		'retainedEarnings',
		'ebit',
		'maretCapitalization',
		'totalLiabilities',
		'revenue',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getAltmanZScore(): float
	{
		return ArrayTypeAssert::floatish($this->data, 'altmanZScore', fn (): string => $this->getSymbol());
	}


	public function getPiotroskiScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'piotroskiScore', fn (): string => $this->getSymbol());
	}


	public function getWorkingCapital(): float|null
	{
		if (($this->data['workingCapital'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'workingCapital', fn (): string => $this->getSymbol());
	}


	public function getTotalAssets(): float|null
	{
		if (($this->data['totalAssets'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'totalAssets', fn (): string => $this->getSymbol());
	}


	public function getRetainedEarnings(): float|null
	{
		if (($this->data['retainedEarnings'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'retainedEarnings', fn (): string => $this->getSymbol());
	}


	public function getEbit(): float|null
	{
		if (($this->data['ebit'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'ebit', fn (): string => $this->getSymbol());
	}


	public function getMaretCapitalization(): float|null
	{
		if (($this->data['marketCap'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'marketCap', fn (): string => $this->getSymbol());
	}


	public function getTotalLiabilities(): float|null
	{
		if (($this->data['totalLiabilities'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'totalLiabilities', fn (): string => $this->getSymbol());
	}


	public function getRevenue(): float|null
	{
		if (($this->data['revenue'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::floatish($this->data, 'revenue', fn (): string => $this->getSymbol());
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
