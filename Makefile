SUPPORTED_COMMANDS := composer-require
SUPPORTS_MAKE_ARGS := $(findstring $(firstword $(MAKECMDGOALS)), $(SUPPORTED_COMMANDS))
ifneq "$(SUPPORTS_MAKE_ARGS)" ""
  COMMAND_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
  $(eval $(COMMAND_ARGS):;@:)
endif


clean:
	docker system prune -a -f

compose:
	docker-compose up --build -d && docker-compose up -d

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

deploy:
	docker-compose -f docker-compose.deploy.yml build fixerio
	docker push bdeuffic/sf_fixerio_euroconverter:latest

composer-require:
	docker-compose run php composer require --prefer-dist --prefer-stable $(COMMAND_ARGS)

