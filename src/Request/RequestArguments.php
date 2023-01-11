<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Request;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class RequestArguments
{

	public function __construct(
		public readonly HttpClientInterface $client,
		public readonly string $method,
		public readonly string $url,
	)
	{
	}

}
