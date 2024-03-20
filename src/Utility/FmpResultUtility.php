<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Utility;

use LogicException;
use ReflectionClass;
use WebChemistry\Fmp\Response\ChildrenResponse;
use WebChemistry\Fmp\Result\FmpResult;

final class FmpResultUtility
{

	/**
	 * @param class-string $className
	 * @return string[]
	 */
	public static function getFields(string $className): array
	{
		$reflection = new ReflectionClass($className);
		$fields = $reflection->getConstant('META_FIELDS');

		if (!is_array($fields)) {
			throw new LogicException(sprintf('Constant META_FIELDS does not exist for %s', $reflection->name));
		}

		return $fields;
	}

	/**
	 * @template T of FmpResult
	 * @param ChildrenResponse<T> $response
	 * @return mixed[]
	 */
	public static function map(ChildrenResponse $response, string $field): array
	{
		$values = [];

		/** @var FmpResult $object */
		foreach ($response->yieldObjects() as $object) {
			$values[] = $object->getSingleParsedData($field);
		}

		return $values;
	}

	public function getFieldValue(object $result, string $field): mixed
	{
		$getter = sprintf('get%s', ucfirst($field));

		if (!method_exists($result, $getter)) {
			throw new LogicException(sprintf('Method %s does not exist in %s.', $getter, $result::class));
		}

		return $result->$getter();
	}

}
