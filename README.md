# Bitcoin Tracker

![Bitcoin Tracker Screenshot](/bitcoin_tracker_screenshot.png?raw=true "Bitcoin Tracker Screenshot")

Bitcoin Tracker is a Laravel 9 + VueJS 3 project for tracking the bitcoin trades compared to USD.

## Prerequisites

- Docker Desktop - [Download from docker.com](https://www.docker.com/products/docker-desktop/)
- Composer - [Download from getcomposer.org](https://getcomposer.org/download/)
- Node.js and npm - [Downloading and installing guide from npmjs.org](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm)

## Local Setup

1. Install all required vendor packages using composer.

```bash
composer install
```

2. Copy configuration file example to create your own configuration file (.env)

```bash
cp .env.example .env
```

3. Generate configuration key

```bash
php artisan key:generate
```

4. Run migrations

```bash
php artisan migrate
```

5. Seed data (***optional***)

```bash
php artisan db:seed
```

5. Install node packages and build assets

```bash
npm install && npm run dev
```

6. Start Laravel Sail (***must have Docker Desktop up and running***)

```bash
./vendor bin sail up -d
```

If you don't want to use Laravel Sail, you should configure your configuration file for database, mail server and start the Queue worker (***which is configured as Supervisor in the Docker container, if using Laravel Sail***) using this command:

```bash
php artisan queue:work
```

## Built with

- [Laravel 9](https://laravel.com/)
- [VueJS 3](https://vuejs.org/)
- [Chart.js](https://www.chartjs.org/)
- [Guzzle HTTP Client](https://laravel.com/docs/9.x/http-client)
- [Laravel Data Object Tools](https://github.com/JustSteveKing/laravel-data-object-tools)
- Passion and desire to succeed

## License

[MIT](https://choosealicense.com/licenses/mit/)
