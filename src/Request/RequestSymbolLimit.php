<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Request;

final class RequestSymbolLimit
{

	private int $limit;

	/**
	 * @param int<1, max> $limit
	 */
	public function __construct(
		private string $url,
		private string $symbols,
		int $limit = 7000,
	)
	{
		$this->limit = $limit - strlen(strtr($this->url, ['%s%' => '']));
	}

	/**
	 * @return string[]
	 */
	public function getUrls(): array
	{
		$symbols = $this->symbols;
		$urls = [];

		do {
			if (strlen($symbols) < $this->limit) {
				$urls[] = strtr($this->url, ['%s%' => $symbols]);

				break;
			}

			$split = $this->splitLeftByNeedleAndPosition($symbols, ',', $this->limit);

			if (!$split) {
				break;
			}

			[$current, $symbols] = $split;

			$urls[] = strtr($this->url, ['%s%' => $current]);
		} while (true);

		return $urls;
	}

	/**
	 * @return array{string, string}|null
	 */
	private function splitLeftByNeedleAndPosition(string $str, string $needle, int $pos): array|null
	{
		do {
			$char = $str[$pos] ?? null;

			if ($char === $needle) {
				break;
			}

			if ($pos === 0) {
				return null;
			}

			$pos--;
		} while (true);

		return $this->splitByPosition($str, $pos);
	}

	/**
	 * @return array{string, string}
	 */
	private function splitByPosition(string $haystack, int $pos, int $length = 1): array
	{
		return [
			substr($haystack, 0, $pos),
			substr($haystack, $pos + $length),
		];
	}

}

