<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Utility;

final class FmpConverter
{

	private const Industry = [
		'N/A' => null,
	];

	public static function convertIndustry(?string $industry): ?string
	{
		if (!$industry) {
			return null;
		}

		return self::Industry[$industry] ?? $industry;
	}

}
