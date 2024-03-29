<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\ArrayTypeAssert;
use WebChemistry\Fmp\Utility\FmpConverter;

final class Profile extends FmpResult implements SymbolResult
{
	public const META_FIELDS = [
		'symbol',
		'price',
		'beta',
		'volAvg',
		'mktCap',
		'lastDiv',
		'range',
		'changes',
		'companyName',
		'currency',
		'cik',
		'isin',
		'cusip',
		'exchange',
		'exchangeShortName',
		'industry',
		'website',
		'description',
		'ceo',
		'sector',
		'country',
		'fullTimeEmployees',
		'phone',
		'address',
		'city',
		'state',
		'zip',
		'dcfDiff',
		'dcf',
		'image',
		'ipoDate',
		'defaultImage',
		'isEtf',
		'isActivelyTrading',
		'isFund',
		'isAdr',
	];

	public function getSymbol(): string
	{
		return ArrayTypeAssert::string($this->data, 'Symbol', fn (): string => sprintf('%s of %s', 'Symbol', $this->getSymbol()));
	}


	public function getPrice(): string|null
	{
		if (($this->data['Price'] ?? null) === '') {
			return null;
		}

		$value = ArrayTypeAssert::string($this->data, 'Price', fn (): string => sprintf('%s of %s', 'Price', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getBeta(): string|null
	{
		$value = ArrayTypeAssert::string($this->data, 'Beta', fn (): string => sprintf('%s of %s', 'Beta', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getVolAvg(): string|null
	{
		$value = ArrayTypeAssert::string($this->data, 'VolAvg', fn (): string => sprintf('%s of %s', 'VolAvg', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getMktCap(): string|null
	{
		$value = ArrayTypeAssert::string($this->data, 'MktCap', fn (): string => sprintf('%s of %s', 'MktCap', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getLastDiv(): string|null
	{
		$value = ArrayTypeAssert::string($this->data, 'LastDiv', fn (): string => sprintf('%s of %s', 'LastDiv', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getRange(): string|null
	{
		if (($this->data['Range'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'Range', fn (): string => sprintf('%s of %s', 'Range', $this->getSymbol()));
	}


	public function getChanges(): string|null
	{
		if (($this->data['Changes'] ?? null) === '') {
			return null;
		}

		$value = ArrayTypeAssert::string($this->data, 'Changes', fn (): string => sprintf('%s of %s', 'Changes', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getCompanyName(): string|null
	{
		if (($this->data['companyName'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'companyName', fn (): string => sprintf('%s of %s', 'companyName', $this->getSymbol()));
	}


	public function getCurrency(): string|null
	{
		if (($this->data['currency'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'currency', fn (): string => sprintf('%s of %s', 'currency', $this->getSymbol()));
	}


	public function getCik(): string|null
	{
		if (($this->data['cik'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'cik', fn (): string => sprintf('%s of %s', 'cik', $this->getSymbol()));
	}


	public function getIsin(): string|null
	{
		if (($this->data['isin'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'isin', fn (): string => sprintf('%s of %s', 'isin', $this->getSymbol()));
	}


	public function getCusip(): string|null
	{
		if (($this->data['cusip'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'cusip', fn (): string => sprintf('%s of %s', 'cusip', $this->getSymbol()));
	}


	public function getExchange(): string|null
	{
		if (($this->data['exchange'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'exchange', fn (): string => sprintf('%s of %s', 'exchange', $this->getSymbol()));
	}


	public function getExchangeShortName(): string|null
	{
		if (($this->data['exchangeShortName'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'exchangeShortName', fn (): string => sprintf('%s of %s', 'exchangeShortName', $this->getSymbol()));
	}


	public function getIndustry(): string|null
	{
		if (($this->data['industry'] ?? null) === '') {
			return null;
		}

		$value = ArrayTypeAssert::string($this->data, 'industry', fn (): string => sprintf('%s of %s', 'industry', $this->getSymbol()));

		$value = FmpConverter::convertIndustry($value);

		return $value;
	}


	public function getWebsite(): string|null
	{
		if (($this->data['website'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'website', fn (): string => sprintf('%s of %s', 'website', $this->getSymbol()));
	}


	public function getDescription(): string|null
	{
		if (($this->data['description'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'description', fn (): string => sprintf('%s of %s', 'description', $this->getSymbol()));
	}


	public function getCeo(): string|null
	{
		if (($this->data['CEO'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'CEO', fn (): string => sprintf('%s of %s', 'CEO', $this->getSymbol()));
	}


	public function getSector(): string|null
	{
		if (($this->data['sector'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'sector', fn (): string => sprintf('%s of %s', 'sector', $this->getSymbol()));
	}


	public function getCountry(): string|null
	{
		if (($this->data['country'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'country', fn (): string => sprintf('%s of %s', 'country', $this->getSymbol()));
	}


	public function getFullTimeEmployees(): string|null
	{
		if (($this->data['fullTimeEmployees'] ?? null) === '') {
			return null;
		}

		$value = ArrayTypeAssert::string($this->data, 'fullTimeEmployees', fn (): string => sprintf('%s of %s', 'fullTimeEmployees', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getPhone(): string|null
	{
		if (($this->data['phone'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'phone', fn (): string => sprintf('%s of %s', 'phone', $this->getSymbol()));
	}


	public function getAddress(): string|null
	{
		if (($this->data['address'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'address', fn (): string => sprintf('%s of %s', 'address', $this->getSymbol()));
	}


	public function getCity(): string|null
	{
		if (($this->data['city'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'city', fn (): string => sprintf('%s of %s', 'city', $this->getSymbol()));
	}


	public function getState(): string|null
	{
		if (($this->data['state'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'state', fn (): string => sprintf('%s of %s', 'state', $this->getSymbol()));
	}


	public function getZip(): string|null
	{
		if (($this->data['zip'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'zip', fn (): string => sprintf('%s of %s', 'zip', $this->getSymbol()));
	}


	public function getDcfDiff(): string|null
	{
		if (($this->data['DCF_diff'] ?? null) === '') {
			return null;
		}

		$value = ArrayTypeAssert::string($this->data, 'DCF_diff', fn (): string => sprintf('%s of %s', 'DCF_diff', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getDcf(): string|null
	{
		$value = ArrayTypeAssert::string($this->data, 'DCF', fn (): string => sprintf('%s of %s', 'DCF', $this->getSymbol()));

		if ($this->isZero($value)) {
			return null;
		}

		return $value;
	}


	public function getImage(): string
	{
		return ArrayTypeAssert::string($this->data, 'image', fn (): string => sprintf('%s of %s', 'image', $this->getSymbol()));
	}


	public function getIpoDate(): string|null
	{
		if (($this->data['ipoDate'] ?? null) === '') {
			return null;
		}

		return ArrayTypeAssert::string($this->data, 'ipoDate', fn (): string => sprintf('%s of %s', 'ipoDate', $this->getSymbol()));
	}


	public function getDefaultImage(): string
	{
		return ArrayTypeAssert::string($this->data, 'defaultImage', fn (): string => sprintf('%s of %s', 'defaultImage', $this->getSymbol()));
	}


	public function getIsEtf(): bool
	{
		$value = ArrayTypeAssert::string($this->data, 'isEtf', fn (): string => sprintf('%s of %s', 'isEtf', $this->getSymbol()));

		$value = strcasecmp($value, "true") === 0;

		return $value;
	}


	public function getIsActivelyTrading(): bool
	{
		$value = ArrayTypeAssert::string($this->data, 'isActivelyTrading', fn (): string => sprintf('%s of %s', 'isActivelyTrading', $this->getSymbol()));

		$value = strcasecmp($value, "true") === 0;

		return $value;
	}


	public function getIsFund(): bool
	{
		$value = ArrayTypeAssert::string($this->data, 'isFund', fn (): string => sprintf('%s of %s', 'isFund', $this->getSymbol()));

		$value = strcasecmp($value, "true") === 0;

		return $value;
	}


	public function getIsAdr(): bool
	{
		$value = ArrayTypeAssert::string($this->data, 'isAdr', fn (): string => sprintf('%s of %s', 'isAdr', $this->getSymbol()));

		$value = strcasecmp($value, "true") === 0;

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
