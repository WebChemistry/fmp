<?php declare(strict_types = 1);

namespace WebChemistry\FmpGenerator;

final class Configuration
{

	/** @var array<Property|CustomProperty> */
	public array $properties = [];

	/**
	 * @param class-string[] $uses
	 */
	public function __construct(
		public readonly string $className,
		public readonly bool $messageWithSymbol = false,
		public readonly bool $containsSymbol = false,
		private readonly array $replacements = [],
		public readonly array $uses = [],
	)
	{
	}

	public function addProperty(
		string $name,
		string $type,
		callable $assert,
		bool $mayNotExist = false,
		bool $zeroIsNull = false,
		bool $emptyIsNull = false,
		?string $fieldName = null,
		string|CommentType|null $commentType = null,
		?string $converter = null,
	): self
	{
		if ($fieldName === null) {
			$fieldName = $name;

			foreach ($this->replacements as $search => $replacement) {
				$fieldName = str_replace($search, $replacement, $fieldName);
			}
		}

		if (($zeroIsNull || $emptyIsNull) && !str_contains($type, 'null')) {
			$type .= '|null';
		}

		$this->properties[$fieldName] = new Property(
			$name,
			$type,
			$fieldName,
			$assert,
			$mayNotExist,
			$zeroIsNull,
			$emptyIsNull,
			is_string($commentType) ? new CommentType($commentType, CommentTypeLocation::VariableMethod) : $commentType,
			$converter,
		);

		return $this;
	}

	/**
	 * @return string[]
	 */
	public function getMethods(): array
	{
		return array_keys($this->properties);
	}

	/**
	 * @param string[] $body
	 */
	public function addCustomProperty(string $name, string $type, array $body): self
	{
		$this->properties[$name] = new CustomProperty($name, $type, $body);

		return $this;
	}

}
