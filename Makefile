d-up:
	docker-compose up -d

d-down:
	docker-compose down

d-build:
	docker-compose build
perm:
	sudo chown ${USER}:${USER} bootstrap/cache -R
	sudo chown ${USER}:${USER} storage -R