#!/bin/bash
set -e

#Download new image version
docker-compose pull

#Set maintenance mode to perform critical operations (database, upgrades, ...)
APP_MAINTENANCE=1 docker-compose down
#docker-compose exec -T app bin/console doctrine:migration:migrate -n
git pull

#back to prod
docker-compose up -d