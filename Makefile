install:
	composer install

autoload:
	composer dump-autoload

lint:
	composer exec 'phpcs --standard=PSR2 src'
	composer exec 'phpcs --standard=PSR2 -l tests'
	composer exec './bin/psrlint src'

test:
	composer exec 'phpunit --color tests --coverage-clover build/logs/clover.xml'
	composer exec 'test-reporter'
