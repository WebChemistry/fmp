<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Exception;

use Exception;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;

final class DecodingException extends Exception implements DecodingExceptionInterface
{

}
