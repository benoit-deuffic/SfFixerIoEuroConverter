.DEFAULT_GOAL := compose

clean:
	docker system prune -a -f

build:
	cd $(path) && docker build -t symfony .

rebuild: clean build

run:
	cd $(path) && docker run --rm -p 81:80 symfony

rerun:  rebuild	run

compose:
	docker-compose up --build -d

publish:
	docker-compose -f docker-compose.deploy.yml build fixerio
	docker-compose -f docker-compose.deploy.yml push fixerio
