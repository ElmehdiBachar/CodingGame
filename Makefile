phpcs:
	@docker exec -it php-con bash -c  'vendor/bin/phpcs --standard=PSR12 src config'

build:
	make build-back
	make build-front

build-back:
	@docker-compose up -d --build
	make composer-install

composer-install:
	@docker exec -it php-con bash -c  'composer install --prefer-dist'

build-front:
	make yarn-install
	make yarn-build

yarn-install:
	@docker exec -it node-con bash -c  'yarn install'

yarn-build:
	@docker exec -it node-con bash -c  'yarn run build'




