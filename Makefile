up:
	sudo docker-compose up -d

down:
	sudo docker-compose down

build:
	sudo docker-compose build

list:
	sudo docker-compose ps

migrate:
	docker-compose exec php-fpm php artisan migrate

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
