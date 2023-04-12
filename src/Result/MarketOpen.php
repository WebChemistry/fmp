<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class MarketOpen extends FmpResult
{
	public const META_FIELDS = [
		'stockExchangeName',
		'stockMarketHours',
		'stockMarketHolidays',
		'isTheStockMarketOpen',
		'isTheEuronextMarketOpen',
		'isTheForexMarketOpen',
		'isTheCryptoMarketOpen',
	];

	public function getStockExchangeName(): string
	{
		return ArrayTypeAssert::string($this->data, 'stockExchangeName');
	}


	/**
	 * @return array{ openingHour: string, closingHour: string }
	 */
	public function getStockMarketHours(): array
	{
		return ArrayTypeAssert::array($this->data, 'stockMarketHours');
	}


	/**
	 * @return array{ year: int, "New Years Day": string|null, "Martin Luther King, Jr. Day": string|null, "Washington\'s Birthday": string|null, "Good Friday": string|null, "Juneteenth National Independence Day": string|null, "Independence Day": string|null, "Labor Day": string|null, "Thanksgiving Day": string|null, "Christmas": string|null}[]
	 */
	public function getStockMarketHolidays(): array
	{
		return ArrayTypeAssert::array($this->data, 'stockMarketHolidays');
	}


	public function getIsTheStockMarketOpen(): bool
	{
		return ArrayTypeAssert::bool($this->data, 'isTheStockMarketOpen');
	}


	public function getIsTheEuronextMarketOpen(): bool
	{
		return ArrayTypeAssert::bool($this->data, 'isTheEuronextMarketOpen');
	}


	public function getIsTheForexMarketOpen(): bool
	{
		return ArrayTypeAssert::bool($this->data, 'isTheForexMarketOpen');
	}


	public function getIsTheCryptoMarketOpen(): bool
	{
		return ArrayTypeAssert::bool($this->data, 'isTheCryptoMarketOpen');
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
