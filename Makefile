test-unit:
	@./vendor/bin/phpunit -c ./ --group unit

test-functional:
	@./vendor/bin/phpunit -c ./ --group functional

test:
	@./vendor/bin/phpunit -c ./

code-coverage:
	@./vendor/bin/phpunit -c ./ --coverage-html ./Resources/docs/code-coverage
	@open ./Resources/docs/code-coverage/index.html

checkstyle:
	@./vendor/bin/phpcs --standard="vendor/instaclick/symfony2-coding-standard/Symfony2" --ignore=Tests/,vendor/ ./

detectmess:
	@@./vendor/bin/phpmd ./ text codesize,unusedcode,naming,design,controversial --exclude Tests/,vendor/

all: phpunit phpcs phpmd
