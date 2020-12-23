# simple-url-shortener
## Requirement:
Lanuage: PHP

Please provide public git repository

1. Implement an URL shortener service
    - Consider all the cases in the given time frame
    - The more complete the cases you can give us, the better
    - A service should be able to handle concurrent access by many.

2. Let us know how to deploy and run without asking you ANY question.
    - The app should be able to launch ANYWHERE

3. Please implement unit test.

## Deployemnt steps:
1. Install Docker & Docker Compose
   - https://docs.docker.com/get-docker/
1. Clone this repository and switch directory path to project root
   - `git clone git@github.com:linusyen/simple-url-shortener.git`
   - `cd simple-url-shortener`
1. Copy .env.example to .env
   - `cp .env.example .env`
1. Run to build docker images
   - `docker-compose up -d`
1. Install dependencies
   - `docker-compose exec laravel composer install` 
1. Generate `APP_KEY` into .env file
   - `docker-compose exec laravel php artisan key:generate --ansi` 
1. Run migration file to create table
   - `docker-compose exec laravel php artisan migrate`
1. Run command to generate keys of URL for shortening URL
   - `docker-compose exec laravel php artisan url-key:generate`

## Start to use URL shorten service
* Default index page is http://localhost:8088
   - You can adjust the default `APP_URL` and `APP_PORT` in `.env` file
