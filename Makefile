.PHONY: install
install:
	mkcert -cert-file certs/local-cert.pem -key-file certs/local-key.pem "app.localhost" "*.app.localhost" "domain.local" "*.domain.local"
	docker compose build

.PHONY: update
update:
	docker compose run --rm frontend yarn install
	docker compose run --rm php composer install

.PHONY: start
start:
	docker compose up -d

.PHONY: stop
stop:
	docker compose down

.PHONY: jest
jest:
	docker compose run --rm frontend yarn jest test/spec

.PHONY: php-cs-fixer
php-cs-fixer:
	docker compose run --rm php bin/php-cs-fixer fix

.PHONY: phpstan
phpstan:
	docker compose run --rm php bin/phpstan analyse --level max public config src
