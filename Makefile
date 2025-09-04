run: docker-run
up: docker-up
down: docker-down
restart: down up
init: composer-install

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans

docker-run:
	docker compose run --rm php-cli php index.php

composer-install:
	docker compose run --rm php-cli composer install

dump-autoload:
	docker compose run --rm php-cli composer dump-autoload
