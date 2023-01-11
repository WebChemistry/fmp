<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Response;

use Symfony\Contracts\HttpClient\ResponseInterface;
use WebChemistry\Fmp\Result\FmpResult;

/**
 * @template T of FmpResult
 */
interface ChildResponse extends ResponseInterface
{

	/**
	 * @return T
	 */
	public function getObject(bool $throw = true): object;

}
