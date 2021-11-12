<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Cash Machine

Cash Machine App

## Requirements
- Local Server (Laragon, Xamp, etc...)
- Composer
- MySQL
- In case you do not have a local server, run the command (when installing dependencies):
```
php artisan serve
```

## Installation
Create database, run the following commands:
- Login to MySQL
```
mysql -u {USER} -p {PASSWORD}
```
- Or Default User
```
mysql -u root -p

```
- Create Data Base
```
mysql CREATE DATABASE cash_machine;
```
- In the project folder, execute the following commands

Install project dependencies
```
composer install
```

Run migrations and seeders
```
php artisan migrate:fresh --seed
```

Install Passport
```
php artisan passport:install
```

# Project proposal
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://adsnetlog.com/img/db.jpg" width="800"></a></p>

# Postman Documentation
https://www.postman.com/collections/36e759a0618d43f3a43a

# Notas
With Laravel Passport we used grant type password
When executing the command:
Install Passport
```
php artisan passport:install
```
Will return the following
```
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client secret: CxiGoiwJqzUFyQPbuW3QQ1jstR4zYc25hOq2CICe
Password grant client created successfully.
Client ID: 2
Client secret: X9hxNXZ35wWPBskv9QUUjNhUi5AiCM5byKZYrwDr
```
You will need the client secret with id 2 to be able to connect.

## Login
- All demo users created have the following password 12345
- Method Post to: {{host}}/oauth/token
```
{
    "grant_type": "password",
    "client_id": "2",
    "client_secret": "X9hxNXZ35wWPBskv9QUUjNhUi5AiCM5byKZYrwDr",
    "username": "gladyce.skiles@example.org",
    "password": "12345"
}
```
Returns the following
```
{
    "token_type": "Bearer",
    "expires_in": 2591999,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIyIiwianRpIjoiNDA0MmFkNGY2MTMzMTUwNGM3NDY0ODUwZWE1ZjAwZWU2OTRhZWJmYTM1NDM2MDIxMWM0NjIyMmM5Y2UzODU1N2FmMjZiOTQ3MTcxYWUyNmMiLCJpYXQiOjE2MzY3MzM3ODEuMTQ0Njk4LCJuYmYiOjE2MzY3MzM3ODEuMTQ0NzA0LCJleHAiOjE2MzkzMjU3ODAuMzcwNjcsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.kJaozqKroc_WdgLbkFgIEr_aFTWD0fMqqci-WWEPnaGj1Kxck3g_SUwcZDRQQJkItXwW9iDDqvArJP8IGQJq9ka-kj_wpEkTYIEPC2eNKHpxoPC08nVBsym-NCw7EB_GiY7B647DNtoR7FFQEiYznn8nCwY-HGAjeOPrESA7e4rGFWc0Y72a9qeAh8tJVuYlamGvMxM85qJft7S1D_Y4cVz7uPq1FxZBdXwrBLgKDbV6eywsR7aRKEftokGkirHbs1oyy0WURlMxLxdmjvgvLNw22UoucSG-94KD8fqmqozN9HJww94liN6iY0wS3DhZof5kEfbCUTzf1kT04l5okmI0DPtsukRwSTBw3jRXTOS3yJsZugAFlkua-sDJw6iwy4T0rEf-4Rnqq7jgzfX-nrcfaBzFYqSXYIvuNn4XNiuMLIupRkQcBpmEAp25QoEd6TzolfqAlV2U7SlDp1RxHvePaXGm9pk_PG_rRE-JR3X8t7JKU6E-xRbeBdphsgMWTOO8nIOZs_EDp8Ruk6O-cAh1cYM_qun2jsQzth83zrvRKeTv3NHGAIGf_dPQeKfA7Zxo17bv7E8DnzRwzOgNmY9v328gEfiukT4eJn6Asfip5vmQRTCxJy0A3oyRZ6p0_cGTIRH9qY03rDRlSxWUpJQ7N04MEmT0VHC589ukZCY",
    "refresh_token": "def50200c6b8f5950e38e135705928acab532a09d47ef2844a4becfe927fdf2a6fd7fac3695ee820aa69e159590388a57a8b1580ef388ae5ad7317438f3e71fb9b20cdda777751b1e83a47243121c86a764c7f8aae281ab424e39914b1b417a6339cddc7a4e7a323aa0561198a5491667be0d3ef46c0f80c150c8b6742e704d23e5022b118d7498580b90615dcc4a0d22a38acd16db3c6fa8a26732038bc59ec4054838021294bb01c694465dc03b22022c1caa93808b17634500b7c0610ec9ae03234f9b0c83c108b45bf1e50d139f9b11776cc51634bb9a1240a27f584af849c3fbf8f8bf2e0e040cd20e430e22b09dd24728251ba74edf2705e77fe6c14f973e05707b5ee99634e67b91193740330e587bc42559ce64ef136edd7c65f546be0400da96926aa5d459cea280bd6549ea467bdf4c96fec779ed8825aa71eca503eb45b78cc29039bf966948f23d1be3eeb6edce4e371ffad0d8566e40c141d6d79"
}
```

You will need the access token to access the routes that require authentication.
