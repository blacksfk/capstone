Project setup
======================
1. Make sure php has been installed (at least `5.6.3`)
2. Download composer from [here](https://getcomposer.org/composer.phar)
3. Depending upon which database (recommend SQLite for testing purposes) you are running, you will need to uncomment the appropriate extensions in your `php.ini`
4. `git clone --branch 0.1 https://github.com/blacksfk/capstone.git`
5. Create a `.env` file in the root of the directory and append the following:  
  `APP_ENV=local`  
  `APP_DEBUG=true`  
  `APP_URL=http://localhost` 
6. Run: `php path/to/composer.phar install --prefer-dist`
7. Create your database; for SQLite recommended location is: `storage/db.sqlite`
8. Assuming SQLite has been chosen append the following to your `.env` (other configurations will require different environment variables):  
  `DB_CONNECTION=sqlite`
  `DB_DATABASE=/absolute/path/to/db.sqlite`
9. Create the following directories in `storage/`:  
  `/framework/`  
  `/framework/cache`  
  `/framework/sessions`  
  `/framework/views`
10. Ensure both `storage/` and `bootstrap/cache` are writable by the webserver (i.e. `755`)
11. Ensure all files are `644`
12. `php artisan migrate --seed`
13. Run: `php artisan serve`
14. Navigate to: `localhost:8000` to browse the project

Default administration login details
--------------------------------------
* username: `admin@admin.com`
* password: `secret`

# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
