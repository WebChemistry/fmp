<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Response;

use Symfony\Contracts\HttpClient\ResponseInterface;
use WebChemistry\Fmp\Request\RequestArguments;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Serializer\HttpDecoder;

/**
 * @template T of FmpResult
 * @implements ChildResponse<T>
 */
final class ObjectResponse extends Response implements ChildResponse
{

	/**
	 * @param class-string<T> $className
	 * @param mixed[] $options
	 */
	public function __construct(
		private readonly string $className,
		HttpDecoder $decoder,
		ResponseInterface $response,
		array $options = [],
	)
	{
		parent::__construct($decoder, $response, $options);
	}

	/**
	 * @return T
	 */
	public function getObject(bool $throw = true): object
	{
		return new ($this->className)($this->toArray($throw), $this->options);
	}

}

