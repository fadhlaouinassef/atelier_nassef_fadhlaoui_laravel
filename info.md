# Aide-mémoire des commandes Laravel

Toutes les commandes `php artisan` doivent être exécutées à la racine du projet.

## Projet et serveur

```bash
php artisan about                 # Informations sur le projet
php artisan list                  # Toutes les commandes disponibles
php artisan help migrate          # Aide d'une commande
php artisan serve                 # Serveur local
php artisan serve --port=8080     # Serveur sur un autre port
php artisan down                  # Mode maintenance
php artisan up                    # Quitter le mode maintenance
php artisan key:generate          # Générer APP_KEY
```

## Création des éléments

```bash
php artisan make:controller ProductController
php artisan make:controller ProductController --resource
php artisan make:controller ProductController --api
php artisan make:model Product
php artisan make:model Product -m                    # Modèle + migration
php artisan make:model Product -mcr                  # Modèle + migration + contrôleur resource
php artisan make:model Product -mfsc                 # Migration + factory + seeder + contrôleur
php artisan make:migration create_products_table
php artisan make:migration add_price_to_products_table --table=products
php artisan make:seeder ProductSeeder
php artisan make:factory ProductFactory --model=Product
php artisan make:request StoreProductRequest
php artisan make:middleware CheckAge
php artisan make:component Alert
php artisan make:command SendReports
php artisan make:event OrderCreated
php artisan make:listener SendOrderNotification --event=OrderCreated
php artisan make:job ProcessOrder
php artisan make:mail OrderShipped
php artisan make:notification InvoicePaid
php artisan make:policy ProductPolicy --model=Product
php artisan make:provider CustomServiceProvider
php artisan make:test ProductTest
php artisan make:test ProductTest --unit
php artisan make:rule Uppercase
php artisan make:resource ProductResource
php artisan make:exception CustomException
php artisan make:trait HasSlug
```

Voir les générateurs disponibles sur la version installée :

```bash
php artisan list make
```

## Routes

```bash
php artisan route:list
php artisan route:list --path=api
php artisan route:list --name=product
php artisan route:clear
php artisan route:cache
```

Exemples dans `routes/web.php` :

```php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::resource('products', ProductController::class);
Route::apiResource('products', ProductController::class);
```

## Base de données et migrations

```bash
php artisan migrate                    # Appliquer les migrations
php artisan migrate:status             # Voir leur état
php artisan migrate:rollback           # Annuler le dernier lot
php artisan migrate:rollback --step=1  # Annuler une migration du dernier lot
php artisan migrate:reset              # Annuler toutes les migrations
php artisan migrate:refresh            # Rollback complet puis migration
php artisan migrate:fresh              # Supprimer toutes les tables puis migrer
php artisan migrate:fresh --seed       # Recréer et remplir la base
php artisan db:seed                     # Exécuter DatabaseSeeder
php artisan db:seed --class=ProductSeeder
php artisan db:show                     # Informations sur la base
php artisan db:table products           # Structure d'une table
php artisan db                          # Client de base de données
```

Attention : `migrate:fresh` supprime toutes les tables et leurs données.

Exemple de migration :

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->decimal('price', 10, 2);
    $table->text('description')->nullable();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->timestamps();
});
```

## Eloquent et Tinker

```bash
php artisan tinker
```

Exemples dans Tinker :

```php
App\Models\User::all();
App\Models\User::find(1);
App\Models\User::where('email', 'test@example.com')->first();
App\Models\User::factory()->count(10)->create();
```

Dans un modèle, déclarer les champs assignables :

```php
protected $fillable = ['name', 'price', 'description'];
```

## Cache et optimisation

```bash
php artisan optimize:clear      # Vider tous les caches Laravel
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize            # Optimisation pour la production
```

Après une modification de `.env`, exécuter `php artisan config:clear` en développement.

## Stockage et fichiers publics

```bash
php artisan storage:link
php artisan storage:unlink
```

Les fichiers publics stockés sur le disque `public` deviennent accessibles via `public/storage` après `storage:link`.

## Files d'attente, tâches et logs

```bash
php artisan queue:work
php artisan queue:listen
php artisan queue:restart
php artisan queue:failed
php artisan queue:retry all
php artisan queue:flush
php artisan schedule:list
php artisan schedule:run
php artisan schedule:work
php artisan pail
```

Pour utiliser les queues avec le pilote `database` :

```bash
php artisan make:queue-table
php artisan make:queue-failed-table
php artisan migrate
```

## Authentification et API

Pour une authentification légère avec Blade :

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install
php artisan migrate
```

Installer le support API Laravel (Sanctum selon la configuration Laravel 12) :

```bash
php artisan install:api
php artisan migrate
```

## Tests et qualité

```bash
php artisan test
php artisan test --filter=ProductTest
php artisan test --coverage
vendor/bin/phpunit
vendor/bin/pint
vendor/bin/pint --test
composer audit
```

Sous PowerShell, les chemins avec `/` fonctionnent généralement; sinon utiliser `vendor\bin\pint`.

## Front-end Vite

```bash
npm install       # Installer/mettre à jour selon package.json
npm ci            # Installation exacte selon package-lock.json
npm run dev        # Serveur Vite et rechargement à chaud
npm run build      # Compilation de production
npm audit          # Audit des dépendances JavaScript
```

## Composer

```bash
composer install
composer require fournisseur/paquet
composer require --dev fournisseur/paquet
composer remove fournisseur/paquet
composer update fournisseur/paquet --with-all-dependencies
composer dump-autoload
composer validate
composer audit
composer run dev
```

## Publication et déploiement

Commandes habituelles sur le serveur de production :

```bash
composer install --no-dev --optimize-autoloader
npm ci
npm run build
php artisan migrate --force
php artisan optimize
php artisan storage:link
php artisan queue:restart
```

Configurer `APP_ENV=production`, `APP_DEBUG=false`, une vraie base de données et les secrets dans l'environnement du serveur. Ne jamais commiter `.env`.

## Git et changement de dépôt distant

```bash
git remote -v
git remote remove origin
git remote add origin https://github.com/UTILISATEUR/NOUVEAU-DEPOT.git
git branch -M main
git push -u origin main
```

`git remote remove origin` retire seulement le lien distant; il ne supprime ni les fichiers ni l'historique Git local.
