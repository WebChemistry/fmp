<?php declare(strict_types = 1);

namespace WebChemistry\FmpGenerator;

final class Property
{

	/** @var callable */
	public $assert;

	public function __construct(
		public readonly string $name,
		public readonly string $type,
		public readonly string $fieldName,
		callable $assert,
		public readonly bool $mayNotExist = false,
		public readonly bool $zeroIsNull = false,
		public readonly bool $emptyIsNull = false,
		public readonly ?string $commentType = null,
		public readonly ?string $converter = null,
	)
	{
		$this->assert = $assert;
	}

}
