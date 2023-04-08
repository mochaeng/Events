<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Technologies Used

-   [x] Docker
-   [x] Meilisearch

## How to run the Project

##### Download composer dependecies

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

##### Create <em>.env</em> file from example

```sh
cp .env.example .env
```

##### Initializing the Application

```sh
docker-compose down --volumes
./vendor/bin/sail up -d --build
./vendor/bin/sail php artisan key:generate
./vendor/bin/sail php artisan migrate
```

##### Setting up Meilisearch

```sh
./vendor/bin/sail artisan scout:index events
./vendor/bin/sail artisan scout:import "App\Models\Event"
```

##### Initializing

```sh
npm install
npm run dev
```

##### Instances

-   App is running on `localhost:8080`
-   phpmyadmin on `localhost:8000`
-   Meilisearch on `localhost:7700`
