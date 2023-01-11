<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use DateTime;
use Typertion\Php\ArrayTypeAssert;

final class Quote extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'price',
		'range',
		'yearHigh',
		'yearLow',
		'change',
		'dayHigh',
		'dayLow',
		'previousClose',
		'volume',
		'averageVolume',
		'priceAvg50',
		'priceAvg200',
		'open',
		'name',
		'exchange',
		'percentageChange',
		'sharesOutstanding',
		'timestamp',
		'marketCapitalization',
		'earningsAnnouncement',
		'eps',
		'pe',
		'datetime',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getPrice(): int|float|null
	{
		if (!array_key_exists('price', $this->data)) {
			return null;
		}

		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'price', fn () => sprintf('%s of %s', 'price', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getRange(): string|null
	{
		if (!array_key_exists('range', $this->data)) {
			return null;
		}

		return ArrayTypeAssert::stringOrNull($this->data, 'range', fn () => sprintf('%s of %s', 'range', $this->getSymbol()));
	}


	public function getYearHigh(): int|float|null
	{
		if (!array_key_exists('yearHigh', $this->data)) {
			return null;
		}

		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'yearHigh', fn () => sprintf('%s of %s', 'yearHigh', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getYearLow(): int|float|null
	{
		if (!array_key_exists('yearLow', $this->data)) {
			return null;
		}

		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'yearLow', fn () => sprintf('%s of %s', 'yearLow', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getChange(): int|float|null
	{
		return ArrayTypeAssert::intOrFloatOrNull($this->data, 'change', fn () => sprintf('%s of %s', 'change', $this->getSymbol()));
	}


	public function getDayHigh(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'dayHigh', fn () => sprintf('%s of %s', 'dayHigh', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDayLow(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'dayLow', fn () => sprintf('%s of %s', 'dayLow', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPreviousClose(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'previousClose', fn () => sprintf('%s of %s', 'previousClose', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getVolume(): int|null
	{
		$value = ArrayTypeAssert::intOrNull($this->data, 'volume', fn () => sprintf('%s of %s', 'volume', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAverageVolume(): int|null
	{
		$value = ArrayTypeAssert::intOrNull($this->data, 'avgVolume', fn () => sprintf('%s of %s', 'avgVolume', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceAvg50(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'priceAvg50', fn () => sprintf('%s of %s', 'priceAvg50', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceAvg200(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'priceAvg200', fn () => sprintf('%s of %s', 'priceAvg200', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOpen(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'open', fn () => sprintf('%s of %s', 'open', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getName(): string|null
	{
		return ArrayTypeAssert::stringOrNull($this->data, 'name', fn () => sprintf('%s of %s', 'name', $this->getSymbol()));
	}


	public function getExchange(): string
	{
		return ArrayTypeAssert::string($this->data, 'exchange', fn () => sprintf('%s of %s', 'exchange', $this->getSymbol()));
	}


	public function getPercentageChange(): int|float|null
	{
		return ArrayTypeAssert::intOrFloatOrNull($this->data, 'changesPercentage', fn () => sprintf('%s of %s', 'changesPercentage', $this->getSymbol()));
	}


	public function getSharesOutstanding(): int|null
	{
		$value = ArrayTypeAssert::intOrNull($this->data, 'sharesOutstanding', fn () => sprintf('%s of %s', 'sharesOutstanding', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTimestamp(): int|null
	{
		return ArrayTypeAssert::intOrNull($this->data, 'timestamp', fn () => sprintf('%s of %s', 'timestamp', $this->getSymbol()));
	}


	public function getMarketCapitalization(): int|null
	{
		$value = ArrayTypeAssert::integerishOrNull($this->data, 'marketCap', fn () => sprintf('%s of %s', 'marketCap', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEarningsAnnouncement(): DateTime|null
	{
		$value = ArrayTypeAssert::stringOrNull($this->data, 'earningsAnnouncement', fn () => sprintf('%s of %s', 'earningsAnnouncement', $this->getSymbol()));

		$value = $this->dateTime($value);

		return $value;
	}


	public function getEps(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'eps', fn () => sprintf('%s of %s', 'eps', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPe(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'pe', fn () => sprintf('%s of %s', 'pe', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDatetime(): DateTime|null
	{
		return $this->dateTime($this->getTimestamp());
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
