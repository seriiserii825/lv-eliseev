up:
	sudo docker-compose up -d

down:
	sudo docker-compose down

down-orphan:
	sudo docker-compose down --remove-orphans

build:
	sudo docker-compose build

ps:
	sudo docker-compose ps

list:
	sudo docker-compose exec php-fpm php artisan route:list -c --name=users

migrate:
	docker-compose exec php-fpm php artisan migrate

clear:
	docker-compose exec php-fpm php artisan view:clear
	docker-compose exec php-fpm php artisan cache:clear
	docker-compose exec php-fpm php artisan config:clear
	docker-compose exec php-fpm php artisan route:clear

seed:
	docker-compose exec php-fpm php artisan db:seed

ide-generate:
	php artisan ide-helper:generate

install:
	docker-compose exec node npm install
prod:
	docker-compose exec node npm run prod
dev:
	docker-compose exec node npm run dev
watch:
	docker-compose exec node npm mix watch

perm:
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} storage -R
