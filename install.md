# Installation d'un projet Laravel

Ce guide suppose que PHP, Composer, Node.js, npm et le serveur de base de données sont déjà installés et configurés sur le PC.

## 1. Créer un nouveau projet Laravel

```bash
composer create-project laravel/laravel mon-projet
cd mon-projet
```

## 2. Installer ce projet existant

Après un clone ou une copie du projet :

```bash
composer install
npm install
```

Quand `package-lock.json` est présent, `npm ci` permet une installation strictement reproductible :

```bash
npm ci
```

Créer la configuration locale et la clé de chiffrement :

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

Sous Linux/macOS, remplacer la copie par `cp .env.example .env`.

Avec SQLite, créer le fichier si nécessaire puis lancer les migrations :

```powershell
New-Item database/database.sqlite -ItemType File -Force
php artisan migrate
```

Avec MySQL, créer d'abord la base, puis renseigner `.env` :

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=root
DB_PASSWORD=
```

Ensuite :

```bash
php artisan migrate
```

## 3. Lancer le projet

Deux terminaux :

```bash
php artisan serve
```

```bash
npm run dev
```

Ou utiliser la commande groupée définie dans `composer.json` :

```bash
composer run dev
```

Le serveur Laravel est normalement accessible sur `http://127.0.0.1:8000`.

Pour compiler les ressources destinées à la production :

```bash
npm run build
```

## 4. Ajouter ou réparer des dépendances Composer

Installer les versions exactes de `composer.lock` :

```bash
composer install
```

Ajouter un paquet :

```bash
composer require fournisseur/paquet
composer require --dev fournisseur/paquet
```

Mettre à jour un seul paquet et ses dépendances :

```bash
composer update fournisseur/paquet --with-all-dependencies
```

Mettre toutes les dépendances à jour uniquement quand cela est volontaire :

```bash
composer update
```

Reconstruire l'autoload après l'ajout manuel de classes :

```bash
composer dump-autoload
```

Diagnostiquer Composer :

```bash
composer diagnose
composer validate
composer audit
```

Ne pas utiliser `--ignore-platform-reqs` comme correction permanente : il peut installer des paquets incompatibles avec PHP.

## 5. Associer le projet à un nouveau dépôt Git

Vérifier qu'aucun ancien dépôt distant n'est configuré :

```bash
git remote -v
```

Ajouter le futur dépôt et pousser la branche :

```bash
git remote add origin https://github.com/UTILISATEUR/NOUVEAU-DEPOT.git
git branch -M main
git push -u origin main
```

Si un remote `origin` existe déjà :

```bash
git remote set-url origin https://github.com/UTILISATEUR/NOUVEAU-DEPOT.git
```

## 6. Vérifications finales

```bash
php artisan about
php artisan test
npm run build
git remote -v
```

Les dossiers `vendor`, `node_modules`, le fichier `.env` et les secrets ne doivent pas être commités.
