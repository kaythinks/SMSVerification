<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Send SMS in a Laravel Application
Send SMS within a Laravel Application using https://bulksmsnigeria.net/sms-gateway-api

### Getting Started
Clone this repository

```bash
git clone https://github.com/yemiwebby/sendSms-laravel.git
```

### Change Directory
```bash
cd sendSms-laravel

```

### install dependencies
```bash
composer install 

```

Don't forget to set up your database credentials
### Database Set up

Create a `.env` file and copy the content of `.env.example` content into it.

Then fill in your credentials

```bash

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Your-database-name
DB_USERNAME=Your-database-username
DB_PASSWORD=Your-database-password

```



```bash

php artisan migrate
```
### Run Application
```bash
php artisan serve

```