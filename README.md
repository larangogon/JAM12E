<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

##Instructions for setup.

- **Install a server side application. Example: Xampp, Wamp, Lampp, Laragon, etc.**
- **Clone the repository on the root. (htdocs for xampp, www for laragon and wamp, etc).**
- **Open terminal and run the following commands:**
 - cd JAM12E
 - composer install
 - npm install
 - cp .env.example .env
 - **Create databases:**
 -mysql -u root
 -create database jam;
 -create database testing_laravel;
 -exit
 -php artisan migrate --seed
- **To finish and deploy the application, run the command:**
- php artisan optimize:clear
- php artisan serve
- **Login.**
- (user: admin@example.com, password: 123).
