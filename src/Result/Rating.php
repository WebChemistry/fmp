<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class Rating extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'date',
		'rating',
		'ratingScore',
		'ratingRecommendation',
		'ratingDetailsDcfScore',
		'ratingDetailsDcfRecommendation',
		'ratingDetailsRoeScore',
		'ratingDetailsRoeRecommendation',
		'ratingDetailsRoaScore',
		'ratingDetailsRoaRecommendation',
		'ratingDetailsDeScore',
		'ratingDetailsDeRecommendation',
		'ratingDetailsPeScore',
		'ratingDetailsPeRecommendation',
		'ratingDetailsPbScore',
		'ratingDetailsPbRecommendation',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getDate(): string
	{
		return ArrayTypeAssert::string($this->data, 'date', fn (): string => sprintf('%s of %s', 'date', $this->getSymbol()));
	}


	public function getRating(): string
	{
		return ArrayTypeAssert::string($this->data, 'rating', fn (): string => sprintf('%s of %s', 'rating', $this->getSymbol()));
	}


	public function getRatingScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'ratingScore', fn (): string => sprintf('%s of %s', 'ratingScore', $this->getSymbol()));
	}


	public function getRatingRecommendation(): string
	{
		return ArrayTypeAssert::string($this->data, 'ratingRecommendation', fn (): string => sprintf('%s of %s', 'ratingRecommendation', $this->getSymbol()));
	}


	public function getRatingDetailsDcfScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'ratingDetailsDCFScore', fn (): string => sprintf('%s of %s', 'ratingDetailsDCFScore', $this->getSymbol()));
	}


	public function getRatingDetailsDcfRecommendation(): string
	{
		return ArrayTypeAssert::string($this->data, 'ratingDetailsDCFRecommendation', fn (): string => sprintf('%s of %s', 'ratingDetailsDCFRecommendation', $this->getSymbol()));
	}


	public function getRatingDetailsRoeScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'ratingDetailsROEScore', fn (): string => sprintf('%s of %s', 'ratingDetailsROEScore', $this->getSymbol()));
	}


	public function getRatingDetailsRoeRecommendation(): string
	{
		return ArrayTypeAssert::string($this->data, 'ratingDetailsROERecommendation', fn (): string => sprintf('%s of %s', 'ratingDetailsROERecommendation', $this->getSymbol()));
	}


	public function getRatingDetailsRoaScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'ratingDetailsROAScore', fn (): string => sprintf('%s of %s', 'ratingDetailsROAScore', $this->getSymbol()));
	}


	public function getRatingDetailsRoaRecommendation(): string
	{
		return ArrayTypeAssert::string($this->data, 'ratingDetailsROARecommendation', fn (): string => sprintf('%s of %s', 'ratingDetailsROARecommendation', $this->getSymbol()));
	}


	public function getRatingDetailsDeScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'ratingDetailsDEScore', fn (): string => sprintf('%s of %s', 'ratingDetailsDEScore', $this->getSymbol()));
	}


	public function getRatingDetailsDeRecommendation(): string
	{
		return ArrayTypeAssert::string($this->data, 'ratingDetailsDERecommendation', fn (): string => sprintf('%s of %s', 'ratingDetailsDERecommendation', $this->getSymbol()));
	}


	public function getRatingDetailsPeScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'ratingDetailsPEScore', fn (): string => sprintf('%s of %s', 'ratingDetailsPEScore', $this->getSymbol()));
	}


	public function getRatingDetailsPeRecommendation(): string
	{
		return ArrayTypeAssert::string($this->data, 'ratingDetailsPERecommendation', fn (): string => sprintf('%s of %s', 'ratingDetailsPERecommendation', $this->getSymbol()));
	}


	public function getRatingDetailsPbScore(): int
	{
		return ArrayTypeAssert::integerish($this->data, 'ratingDetailsPBScore', fn (): string => sprintf('%s of %s', 'ratingDetailsPBScore', $this->getSymbol()));
	}


	public function getRatingDetailsPbRecommendation(): string
	{
		return ArrayTypeAssert::string($this->data, 'ratingDetailsPBRecommendation', fn (): string => sprintf('%s of %s', 'ratingDetailsPBRecommendation', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
