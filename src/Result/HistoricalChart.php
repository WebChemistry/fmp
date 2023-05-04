<?php

declare(strict_types=1);

namespace WebChemistry\Fmp\Result;

use Typertion\Php\TypeAssert;

final class HistoricalChart extends FmpResult
{
	public const META_FIELDS = ['items'];

	/**
	 * @return HistoricalChartItem[]
	 */
	public function getItems(): array
	{
		return array_map(
			fn (mixed $item): HistoricalChartItem => new HistoricalChartItem(TypeAssert::array($item), $this->options),
			$this->data,
		);
	}


	/**
	 * @return string[]
	 */
	protected function getFieldNames(): array
	{
		return self::META_FIELDS;
	}
}
