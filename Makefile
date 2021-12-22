###########
# DOCKER

up:
	docker-compose up -d

down:
	docker-compose down

php:
	docker-compose exec --user www-data:www-data php bash

#up:
#    docker-compose up -d
#
#ps:
#  docker-compose ps
#
#dd:
#  docker-compose down --remove-orphans
#
#db:
#  docker-compose up --build -d
#
#down-orphans:
#  docker-compose down --remove-orphans