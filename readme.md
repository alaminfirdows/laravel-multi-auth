# Multi Auth for Laravel 6.\*

-   `php artisan laravel-multi-auth:install {guard} -f`
-   `php artisan laravel-multi-auth:install {guard} -f --domain`
-   `php artisan laravel-multi-auth:install {guard} {service} -f --lucid`

## What it does?

This a simple package to create the multi authentication feature on your Laravel 6.\* project. By running some simple command you can setup multi auth for your Laravel project. The package installs:

-   Model
-   Migration
-   Controllers
-   Notification
-   Routes
    -   routes/web.php
        -   {guard}/login
        -   {guard}/register
        -   {guard}/logout
        -   Password Reset Routes
            -   {guard}/password/reset
            -   {guard}/password/email
    -   routes/{guard}.php
        -   {guard}/home
-   Middleware
-   Views
-   Guard
-   Provider
-   Password Broker
-   Settings

## Usage

### Step 1: Install Through Composer

```
composer require alaminfirdows/laravel-multi-auth
```

### Step 2: Install Multi Auth in Your Project

```
php artisan laravel-multi-auth:install {singular_lowercase_name_of_guard} -f

// Examples
php artisan laravel-multi-auth:install admin -f
php artisan laravel-multi-auth:install employee -f
php artisan laravel-multi-auth:install customer -f
```

Notice:
If you don't provide `-f` flag, it will not work. It is a protection against accidental activation.

Alternative:

If you want to install Multi-Auth files in a subdomain you must pass the option `--domain`.

```
php artisan laravel-multi-auth:install admin -f --domain
php artisan laravel-multi-auth:install employee -f --domain
php artisan laravel-multi-auth:install customer -f --domain
```

To be able to use this feature properly, you should add a key to your .env file:

```
APP_DOMAIN=yourdomain.com
```

This will allow us to use it in the routes file, prefixing it with the domain feature from Laravel routing system.

Using it like so: `['domain' => '{guard}.' . env('APP_DOMAIN')]`

### Step 3: Migrate new model table

```
php artisan migrate
```

### Step 4: Try it

Go to: `http://project_url/GuardName/login`

Example: `http://myproject.dev/customer/login`

## Options

If you don't want model and migration use `--model` flag.

```
php artisan laravel-multi-auth:install admin -f --model
```

If you don't want views use `--views` flag.

```
php artisan laravel-multi-auth:install admin -f --views
```

If you don't want routes in your `routes/web.php` file, use `--routes` flag.

```
php artisan laravel-multi-auth:install admin -f --routes
```

## Note

If you want to change the redirect path for once your `guard` is logged out. Add and override the following method in
your {GuardName}\Auth\LoginController:

```php
/**
 * Get the path that we should redirect once logged out.
 * Adaptable to user needs.
 *
 * @return string
 */
public function logoutToPath() {
    return '/';
}
```

## Files which are changed and added by this package

-   config/auth.php

    -   Add guards, providers, passwords

-   app/Http/Providers/RouteServiceProvider.php

    -   Register routes

-   app/Http/Kernel.php

    -   Register middleware

-   app/Http/Middleware/

    -   Middleware for each guard

-   app/Http/Controllers/{Guard}/Auth/

    -   New controllers

-   app/Models/{Guard}.php

    -   New Model

-   app/Notifications/{Guard}/ResetPassword.php

    -   Reset password notification

-   database/migrations/

    -   Migration for new model

-   routes/web.php

    -   Register routes

-   routes/{guard}.php

    -   Routes file for given guard

-   resources/views/{guard}/
    -   Views for given guard

## Changelog

### Note: Never install configurations with same guard again after installed new version of package. So if you already installed your `admin` guard, don't install it again after you update package to latest version.

### v0.0.1-alpha

-   Updated all deprecated string helpers to Laravel 6.0
-   Reform Controllers Path and namespace
-   Reform Models Path and namespace

## Special thanks to [Piotr Łosiak (Hesto)](https://github.com/hesto/)

I inspired to create this package from [hesto/multi-auth](https://packagist.org/packages/hesto/multi-auth).
