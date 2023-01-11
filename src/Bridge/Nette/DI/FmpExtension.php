<?php declare(strict_types = 1);

namespace WebChemistry\Fmp\Bridge\Nette\DI;

use Nette\DI\CompilerExtension;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;
use WebChemistry\Fmp\FmpClient;

final class FmpExtension extends CompilerExtension
{

	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'apiKey' => Expect::string()->required(),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		/** @var stdClass $config */
		$config = $this->getConfig();

		$builder->addDefinition($this->prefix('client'))
			->setFactory(FmpClient::class, [
				'apiKey' => $config->apiKey,
			]);
	}

}
