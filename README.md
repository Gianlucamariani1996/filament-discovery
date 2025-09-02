# Creazione nuovo progetto filament

* `cd Desktop`
* `composer create-project laravel/laravel filament-discovery`
* `cd filament-discovery`
* `cp .env.example .env`
* `php artisan key:generate`
* `touch database/database.sqlite`
* nel .env:
    `DB_CONNECTION=sqlite`
    `DB_DATABASE=/Users/tuo-utente/Projects/filament-app/database/database.sqlite`
* `composer require filament/filament`
* `php artisan migrate`
* `php artisan filament:install`
* `php artisan make:filament-panel app`

* Creazione User: `php artisan make:filament-user`

* Avvio: `php artisan serve`

Opzionale (Se si usano componenti frontend personalizzati):
* `npm install`
* `npm run dev`