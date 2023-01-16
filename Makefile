test:
	vendor/bin/tester tests --stop-on-fail
phpstan:
	vendor/bin/phpstan analyse
build:
	php bin/generate.php
