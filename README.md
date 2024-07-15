## About
Donation Application

## Requirements
- PHP >= 8.0
- Laravel >= 9.0
- MySql >= 5.6

## Installation
Laravel utilizes composer to manage its dependencies. So, before using Laravel, make sure you have composer installed on your machine. To download all required packages run this command.
- composer install `OR` COMPOSER_MEMORY_LIMIT=-1 composer install

## Database Setup
Set your database credential against these in .env file.

- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=laravel
- DB_USERNAME=
- DB_PASSWORD=

Use these command to create database scheme with default data.
- php artisan migrate
- php artisan db:seed

## Run project
Use this command on run project without docker
- php artisan serve

## Note
The seeder will create two user types: a standard user and an admin user.

#### Admin Access: 
Administrators have access to both the admin panel and the front-end application at http://localhost:8000/admin. This allows them to manage administrative functions and interact with the front-end features.
#### User Access: 
Regular users are limited to accessing the front-end application only, available at http://localhost:8000. This enables them to utilize the application's core functionalities without administrative privileges.
