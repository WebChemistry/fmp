<?php declare(strict_types = 1);

namespace WebChemistry\FmpGenerator;

final class CustomProperty
{

	/**
	 * @param string[] $body
	 */
	public function __construct(
		public readonly string $name,
		public readonly string $type,
		public readonly array $body
	)
	{
	}

}
