<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;

final class SymbolItem extends FmpResult implements SymbolResult
{
	public const META_FIELDS = ['symbol', 'name', 'price', 'exchange', 'exchangeShortName', 'type'];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'symbol');
	}


	public function getName(): string|null
	{
		return ArrayTypeAssert::stringOrNull($this->data, 'name', fn (): string => sprintf('%s of %s', 'name', $this->getSymbol()));
	}


	public function getPrice(): float|null
	{
		$value = ArrayTypeAssert::floatishOrNull($this->data, 'price', fn (): string => sprintf('%s of %s', 'price', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getExchange(): string|null
	{
		return ArrayTypeAssert::stringOrNull($this->data, 'exchange', fn (): string => sprintf('%s of %s', 'exchange', $this->getSymbol()));
	}


	public function getExchangeShortName(): string|null
	{
		return ArrayTypeAssert::stringOrNull($this->data, 'exchangeShortName', fn (): string => sprintf('%s of %s', 'exchangeShortName', $this->getSymbol()));
	}


	public function getType(): string
	{
		return ArrayTypeAssert::string($this->data, 'type', fn (): string => sprintf('%s of %s', 'type', $this->getSymbol()));
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
