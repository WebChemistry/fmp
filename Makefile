test:
	vendor/bin/tester tests/src
phpstan:
	vendor/bin/phpstan analyse
build:
	php bin/generate.php
