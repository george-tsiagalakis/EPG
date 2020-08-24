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
    
*) Check PSR-12:

    vendor/bin/ecs check ./app --set psr-12 &&
    
    vendor/bin/ecs check ./routes --set psr-12 &&
    
    vendor/bin/ecs check ./database --set psr-12 &&
    
    vendor/bin/ecs check ./tests --set psr-12

**POSTMAN**

A Postman file in included in /misc. However my version of Postman (7.30.1 on Linux) seems to have a problem saving endpoint URL values, either via a full data dump or collection export. As such, once importing the Postman dump it will provide all endpoints + env variables but without the URL values being present, so once importing navigate to Collections/EPG, switch to the "env" environment, and c/p the following values to the respective endpoints, and edit the env vars to having appropriate values:

 - GET List of channels -> {{host}}/{{base}}/channels
 - GET Programme timetable ->
   {{host}}/{{base}}/channels/{{channel_uuid}}/{{date}}/{{timezone}}
 - GET Programme information ->
   {{host}}/{{base}}/channels/{{channel_uuid}}/programmes/{{programme_uuid}}

**ERD**

* A PDF ERD of the database is included in /misc.
