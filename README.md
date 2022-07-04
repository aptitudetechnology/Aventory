# Awia for Nurseries

Awia for Nurseries is a web application to help nurseries manage their plant and product inventory, create and manage invoices, and view reports.

## Screenshots

![Login Screen](./.screenshots/login.png)
![registration page](./.screenshots/registration.png)
![view inventory](./.screenshots/view-inventory.png)

## Screenshots

![Login Screen](./.screenshots/login.png)
![registration page](./.screenshots/registration.png)
![view inventory](./.screenshots/view-inventory.png)

## Frameworks used

- Laravel/PHP for the backend.
- VueJs/InertiaJS for the frontend.

## Technologies

- MySQL
- PHP
- Javascript
- HTML
- CSS
- TailwindCSS
- VueJS
- Laravel
- InertiaJS

## License

This project is confidential and is not open source. Do not distribute or publish any part of the source code or archetecture without prior written consent.

## About Application

## Modules

- Nursery Management
- Customer Management
- Product Management
- Order Management
- Team Management
- Vendor Management
- Purchase Management
- Profile update, Password update, Account deletion
- Secure account with Two FA
- Browser session management

## Architecture

### Backend

User Authentication : Laravel Jetstream + Laravel Sanctum package (Token based)
User Permissions : Laravel Jetstream
Session : Managed by Sanctum (Database based)
Middleware : Sanctum auth
Models : Default Laravel core Eloquent with relationship (ORM)
Views : Loaded by Inertia (JSON based)

### Frontend

VueJs : Component based (Client state management)
InertiaJS : Bridge between server & client for single vue component
Routing : Handled by InertiaJS
Bundling : Webpack & Laravel Mix

## Installation

- Open terminal @ Awia-For-Nurseries folder
- Install packages Run : `composer install`
- Copy sample env `cp .env.example .env`
- Open .env file and update DB setting
- Create a Database in pgsql (Postgres)
- Generate App key : `php artisan key:generate`
- Generate all tables : `php artisan migrate`
- Serve application : `php artisan serve`
