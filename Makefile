install:
	sudo docker-compose down --remove-orphans
	sudo docker-compose build
	sudo docker-compose up -d
	sudo docker-compose run --rm fpm composer install
	sudo docker-compose run --rm fpm php artisan migrate
	sudo docker-compose run --rm fpm chmod -R 777 /var/www/storage

rebuild:
	sudo docker-compose down
	sudo docker-compose build
	sudo docker-compose up -d

chmod:
	sudo chmod -R 777 ./laravel

phpcli:
	sudo docker exec -it php_cli bash

dropdb:
	sudo docker-compose run --rm fpm php artisan migrate:fresh
	sudo docker-compose run --rm fpm php artisan db:seed

npmbuild:
	cd ./laravel && npm run build && cd ./../..