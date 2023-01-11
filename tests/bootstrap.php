<?php

// The Nette Tester command-line runner can be
// invoked through the command: ../vendor/bin/tester .

declare(strict_types=1);

use Nette\Utils\FileSystem;

ini_set('memory_limit', '2G');

if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo 'Install Nette Tester using `composer install`';
	exit(1);
}

function getApiKey(): string
{
	$filePath = dirname(__DIR__) . '/api_key';

	if (!file_exists($filePath)) {
		throw new LogicException(sprintf('Please create file %s with api key.', $filePath));
	}

	return trim(FileSystem::read($filePath));
}

// configure environment
Tester\Environment::setup();

function getTempDir(): string
{
	$dir = __DIR__ . '/tmp/' . getmypid();

	if (empty($GLOBALS['\\lock'])) {
		// garbage collector
		$GLOBALS['\\lock'] = $lock = fopen(__DIR__ . '/lock', 'w');
		if (rand(0, 100)) {
			flock($lock, LOCK_SH);
			@mkdir(dirname($dir));
		} elseif (flock($lock, LOCK_EX)) {
			Tester\Helpers::purge(dirname($dir));
		}

		@mkdir($dir);
	}

	return $dir;
}


function test(string $title, callable $function): void
{
	$function();
}
