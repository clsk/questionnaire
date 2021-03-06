# Questionnaire

The main purpose of this application is being abel to track behavioural questions in time.
For this, we present a questionnaire to the user everytime they log back in.

TODO:
- Implement Dashboard for seeing answer history

## Running
To run, you can use Laradock (http://laradock.io/)
1. Make sure you have Docker installed (https://www.docker.com/get-docker)
2. `git clone https://github.com/clsk/questionnaire.git`
3. `git clone https://github.com/Laradock/laradock.git`
4. `cd laradock`
5. `cp env-example .env`
6. Edit .env file with your favorite editor. The only thing you should need to change is the APPLICATION directory. ie: `APPLICATION=../questionnaire/`
7. Go to this project's directory: `cd ../questionnaire`
8. `cp .env.example .env`
9. Configure this project's .env (See laradock documentation for services' credentials).
if using postgres replace DB connection with:
```
    DB_CONNECTION=pgsql
    DB_HOST=postgres
    DB_PORT=5432
    DB_DATABASE=default
    DB_USERNAME=default
    DB_PASSWORD=secret
```
10. Install the docker containers: `docker-compose up -d nginx php-fpm postgres workspace`
11. Enter the workspace shell: In laradock's folder run: `docker-compose exec workspace bash`
12. Install composer packages: `composer install`
12. Run DB migrations: `php artisan migrate`
13. Run DB seeder: `php artisan db:seed`
13. Generate Laravel encryption key: `php artisan key:generate`
14. Open your browser and visit localhost
15. Enjoy

You may also use Laravel's Homestead vagrant-based environment (https://laravel.com/docs/5.6/homestead)

## Testing
1. Create database questionnaire_testing
2. run: `phpunit`

This is a Laravel App; Laravel's README is below:

<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
