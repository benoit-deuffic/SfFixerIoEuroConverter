clean:
	docker system prune -a -f

compose:
	docker-compose up --build -d

start:
	docker-compose start

stop:
	docker-compose stop

rebuild: stop clean compose up

up:
	docker-compose up -d

down:
	docker-compose down

cc:
	docker-compose run php bin/console cache:clear
