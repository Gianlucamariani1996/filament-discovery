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

# Avvio Progetto

* `composer install`
* `php artisan key:generate`
* `cp .env.example .env`
* `touch database/database.sqlite`
* nel .env:
    `DB_CONNECTION=sqlite`
    `DB_DATABASE=/Users/tuo-utente/Projects/filament-app/database/database.sqlite`
* `php artisan migrate`

* Creazione User: `php artisan make:filament-user`

# Creazione Modello

* `php artisan make:model Product -m`
* `php artisan make:model Season -m`
* `php artisan make:model Category -m`
* `php artisan migrate`

# Creazione Risorse Filament 

* `php artisan make:filament-resource Product`
* `php artisan make:filament-resource Season`
* `php artisan make:filament-resource Category`

# Aggiunta di un campo

* creare la migration: `php artisan make:migration add_status_to_products_table --table=products`
* aggiornare `Product.php` (campo `$fillable`)
* `php artisan migrate`
* modificare `ProductsTable.php`, `ProductResource.php`, `ProductForm.php` se necessario

# Import e Export excel

* `php artisan make:queue-batches-table`
* `php artisan make:notifications-table` 
* `php artisan vendor:publish --tag=filament-actions-migrations`
* `php artisan migrate`

## Exporter
* `php artisan make:filament-exporter Product --generate`

Una volta eseguiti questi comandi aggiungere la BulkAction in `ProductExporter.php`:
```php
ExportBulkAction::make()
    ->exporter(ProductExporter::class),
```

## Importer
* `php artisan make:filament-importer Product --generate`

A questo punto avviare la coda `php artisan queue:listen`.

# Creazione API

(https://laravel.com/docs/12.x/routing)
`php artisan install:api`

Per vedere il token associato ad uno user e testarlo:
`php artisan tinker`
`$user = \App\Models\User::first();`
`$token = $user->createToken('dev')->plainTextToken;` crea una riga nella tabella `personal_access_tokens`
```bash
curl -H "Accept: application/json" \
     -H "Authorization: Bearer 1|ywSH2Fv1VnldY1QzRjTssHgH8lKLzIj8mX19tgfaca361755" \
     http://127.0.0.1:8000/api/user
```