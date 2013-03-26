phpcs:
	@./vendor/bin/phpcs --standard=vendor/instaclick/symfony2-coding-standard/Symfony2 --ignore=vendor .

phpmd:
	@./vendor/bin/phpmd ./ text codesize,controversial,design,naming,unusedcode --exclude vendor/