<?php declare(strict_types = 1);

namespace WebChemistry\FmpGenerator;

use LogicException;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\Printer;
use Nette\Utils\FileSystem;
use ReflectionFunction;
use Typertion\Php\ArrayTypeAssert;
use WebChemistry\Fmp\Result\FmpResult;
use WebChemistry\Fmp\Result\SymbolResult;

final class Generator
{

	/**
	 * @param Configuration[] $configurations
	 */
	public function __construct(
		private readonly array $configurations,
	)
	{
	}

	public function generate(): void
	{
		$printer = new Printer();
		$namespace = 'WebChemistry\\Fmp\\Result';

		foreach ($this->configurations as $configuration) {
			$file = new PhpFile();
			$file->setStrictTypes();

			$filePath = sprintf('%s/../src/Result/%s.php', __DIR__, $configuration->className);

			$namespaceType = $file->addNamespace($namespace);
			$namespaceType->addUse(ArrayTypeAssert::class);

			foreach ($configuration->uses as $use) {
				$namespaceType->addUse($use);
			}

			$class = $namespaceType->addClass($configuration->className);
			$class->setExtends(FmpResult::class);
			$class->setFinal();
			$class->addConstant('META_FIELDS', $configuration->getMethods());

			if ($configuration->containsSymbol) {
				$class->addImplement(SymbolResult::class);
			}

			$this->addProperties($configuration, $class);

			$class->addMethod('getFieldNames')
				->setProtected()
				->setReturnType('array')
				->setComment('@return string[]')
				->addBody('return self::META_FIELDS;');

			FileSystem::write($filePath, $printer->printFile($file));
		}
	}

	private function addProperties(Configuration $configuration, ClassType $class): void
	{
		foreach ($configuration->properties as $property) {
			if ($property instanceof Property) {
				$this->createProperty($class, $configuration, $property);
			} else {
				$this->createCustomProperty($class, $property);
			}

		}
	}

	private function createProperty(ClassType $class, Configuration $configuration, Property $property): void
	{
		$reflection = new ReflectionFunction($property->assert);
		$assertClass = $reflection->getClosureCalledClass()?->getName();

		if ($assertClass !== ArrayTypeAssert::class) {
			throw new LogicException();
		}

		$assertMethod = $reflection->getName();

		$method = $class->addMethod(sprintf('get%s', ucfirst($property->fieldName)))
			->setReturnType($property->type);

		if ($property->commentType) {
			$method->addComment(sprintf('@return %s', $property->commentType));
		}

		if ($property->mayNotExist) {
			$method->addBody('if (!array_key_exists(?, $this->data)) {', [$property->name]);
			$method->addBody("\treturn null;");
			$method->addBody('}');

			$method->addBody('');
		}

		$earlyReturn = !$property->zeroIsNull && !$property->converter;

		$messageWithSymbol = $configuration->messageWithSymbol && $property->name !== 'symbol';

		if ($property->emptyIsNull) {
			$method->addBody('if (($this->data[?] \?\? null) === \'\') {', [$property->name]);
			$method->addBody("\treturn null;");
			$method->addBody('}');
			$method->addBody('');
		}

		if ($property->commentType) {
			$method->addBody(sprintf('/** @var %s%s */', $earlyReturn ? '' : ' $value', $property->commentType));
		}

		$method->addBody(sprintf(
			'%s %s::%s($this->data, ?%s);',
			$earlyReturn ? 'return' : '$value =',
			'ArrayTypeAssert',
			$assertMethod,
			$messageWithSymbol ? ', fn (): string => sprintf(\'%s of %s\', \'' . $property->name . '\', $this->getSymbol())' : '',
		), [
			$property->name,
		]);

		if ($earlyReturn) {
			return;
		}

		$method->addBody('');

		if ($property->converter) {
			$method->addBody($property->converter);
		}

		if ($property->zeroIsNull) {
			$method->addBody('if ($this->isZero($value)) {');
			$method->addBody("\treturn null;");
			$method->addBody('}');
		}

		$method->addBody('');
		$method->addBody('return $value;');
	}

	private function createCustomProperty(ClassType $class, CustomProperty $property): void
	{
		$method = $class->addMethod(sprintf('get%s', ucfirst($property->name)))
			->setReturnType($property->type);

		foreach ($property->body as $row) {
			$method->addBody($row);
		}
	}

}
