A demo API using Laravel 7.

**SETUP**

While in root directory:

1) Install composer dependencies:

    composer install

2) Setup/Check your .env file db connection is valid (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

3) Run database migrations and seeders:

    php artisan migrate --seed

4) Run tests:

    php artisan test

6) Quick data check:

    curl {server}/api/v1/channels (where server is your 127.0.0.1 or other)

**Coding standards check**

    vendor/bin/ecs check ./app --set psr-12 &&
    
    vendor/bin/ecs check ./routes --set psr-12 &&
    
    vendor/bin/ecs check ./database --set psr-12 &&
    
    vendor/bin/ecs check ./tests --set psr-12
