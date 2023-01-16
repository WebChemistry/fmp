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

		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'price', fn (): string => $this->getSymbol());

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

		return ArrayTypeAssert::stringOrNull($this->data, 'range', fn (): string => $this->getSymbol());
	}


	public function getYearHigh(): int|float|null
	{
		if (!array_key_exists('yearHigh', $this->data)) {
			return null;
		}

		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'yearHigh', fn (): string => $this->getSymbol());

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

		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'yearLow', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getChange(): int|float|null
	{
		return ArrayTypeAssert::intOrFloatOrNull($this->data, 'change', fn (): string => $this->getSymbol());
	}


	public function getDayHigh(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'dayHigh', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDayLow(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'dayLow', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPreviousClose(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'previousClose', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getVolume(): int|null
	{
		$value = ArrayTypeAssert::intOrNull($this->data, 'volume', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getAverageVolume(): int|null
	{
		$value = ArrayTypeAssert::intOrNull($this->data, 'avgVolume', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceAvg50(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'priceAvg50', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPriceAvg200(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'priceAvg200', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getOpen(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'open', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getName(): string|null
	{
		return ArrayTypeAssert::stringOrNull($this->data, 'name', fn (): string => $this->getSymbol());
	}


	public function getExchange(): string|null
	{
		if (!array_key_exists('exchange', $this->data)) {
			return null;
		}

		return ArrayTypeAssert::stringOrNull($this->data, 'exchange', fn (): string => $this->getSymbol());
	}


	public function getPercentageChange(): int|float|null
	{
		return ArrayTypeAssert::intOrFloatOrNull($this->data, 'changesPercentage', fn (): string => $this->getSymbol());
	}


	public function getSharesOutstanding(): int|null
	{
		$value = ArrayTypeAssert::intOrNull($this->data, 'sharesOutstanding', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getTimestamp(): int|null
	{
		return ArrayTypeAssert::intOrNull($this->data, 'timestamp', fn (): string => $this->getSymbol());
	}


	public function getMarketCapitalization(): int|null
	{
		$value = ArrayTypeAssert::integerishOrNull($this->data, 'marketCap', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getEarningsAnnouncement(): DateTime|null
	{
		$value = ArrayTypeAssert::stringOrNull($this->data, 'earningsAnnouncement', fn (): string => $this->getSymbol());

		$value = $this->dateTime($value);

		return $value;
	}


	public function getEps(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'eps', fn (): string => $this->getSymbol());

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPe(): int|float|null
	{
		$value = ArrayTypeAssert::intOrFloatOrNull($this->data, 'pe', fn (): string => $this->getSymbol());

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
