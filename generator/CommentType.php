<?php declare(strict_types = 1);

namespace WebChemistry\FmpGenerator;

final class CommentType
{

	public function __construct(
		private string $type,
		private CommentTypeLocation $location,
	)
	{
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function getLocation(): CommentTypeLocation
	{
		return $this->location;
	}

	public function isInMethod(): bool
	{
		return $this->location === CommentTypeLocation::Method || $this->location === CommentTypeLocation::VariableMethod;
	}

	public function isInVariable(): bool
	{
		return $this->location === CommentTypeLocation::Variable || $this->location === CommentTypeLocation::VariableMethod;
	}

}
