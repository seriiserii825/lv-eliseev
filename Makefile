d-up:
	sudo docker-compose up -d

d-down:
	sudo docker-compose down

d-build:
	sudo docker-compose build

d-list:
	sudo docker-compose ps

a-migrate:
	docker exec php php artisan migrate

n-install:
	docker exec node npm install

perm:
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} storage -R