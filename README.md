# Laravel_CRUD_API

Setup the Laravel Application:
    docker exec -it laravel_crud_api_mariadb_1 bash
    mysql -uroot -p
    CREATE DATABASE `api-project`;
    docker exec -it laravel_crud_api_myapp_1 bash
    php artisan make:model Student --migration (create a new migration file for the model)
    php artisan migrate
