# Workstation Management

## Getting started
docker run --rm -it -v $(pwd):/app bitnami/php-fpm composer create-project laravel/laravel WorkstationManagement
docker run --rm -it -v $(pwd):/app bitnami/php-fpm composer require laravel/sail --dev
docker run --rm -it -v $(pwd):/app bitnami/php-fpm php artisan sail:install
sudo chown -R aragon: .
sail up -d
sail composer require pestphp/pest --dev --with-all-dependencies
sail test


