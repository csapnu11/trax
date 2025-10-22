
---

# **Laravel Project Guide Sheet**

---

## **1. Project Setup**

### **Create a new Laravel project**

```bash
composer create-project laravel/laravel project-name
```

### **Local development**

```bash
php artisan serve
```

Runs Laravel’s local PHP server at `http://127.0.0.1:8000`.

---

## **2. Directory Structure (Quick Reference)**

| Directory    | Purpose                                              |
| ------------ | ---------------------------------------------------- |
| `app/`       | Application logic (controllers, models, middleware)  |
| `bootstrap/` | Framework bootstrapping and caching                  |
| `config/`    | All configuration files                              |
| `database/`  | Migrations, seeders, and factories                   |
| `public/`    | Web root, contains `index.php` and built assets      |
| `resources/` | Views (Blade), CSS/JS (Vite), and localization files |
| `routes/`    | Web, API, console, and channel route definitions     |
| `storage/`   | Logs, cache, sessions, file uploads                  |
| `tests/`     | Automated tests                                      |
| `vendor/`    | Composer dependencies                                |

---

## **3. Environment Configuration**

### **Main environment file**

```
.env
```

### **Common settings**

```env
APP_NAME=TRAX
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=trax_db
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

### **Generate app key**

```bash
php artisan key:generate
```

---

## **4. Routing Basics**

**File:** `routes/web.php`

```php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
```

**List all routes**

```bash
php artisan route:list
```

---

## **5. Controllers & Models**

### **Create a controller**

```bash
php artisan make:controller TaskController
```

### **Create a model with migration**

```bash
php artisan make:model Task -m
```

### **Create resource controller (CRUD)**

```bash
php artisan make:controller TaskController --resource
```

---

## **6. Database and Migrations**

### **Run all migrations**

```bash
php artisan migrate
```

### **Rollback last migration**

```bash
php artisan migrate:rollback
```

### **Refresh migrations**

```bash
php artisan migrate:refresh
```

### **Seed database**

```bash
php artisan db:seed
```

### **Create seeder**

```bash
php artisan make:seeder TaskSeeder
```

---

## **7. Eloquent ORM (Quick Reference)**

### **Basic CRUD**

```php
// Create
Task::create(['title' => 'New Task']);

// Read
$tasks = Task::all();

// Update
$task = Task::find(1);
$task->update(['status' => 'completed']);

// Delete
Task::destroy(1);
```

### **Relationships**

```php
// One to many
public function tasks() {
    return $this->hasMany(Task::class);
}

// Belongs to
public function user() {
    return $this->belongsTo(User::class);
}
```

---

## **8. Blade Templates**

### **Load view**

```php
return view('dashboard');
```

### **Variables in Blade**

```blade
<h1>{{ $task->title }}</h1>
```

### **Loops & conditionals**

```blade
@foreach ($tasks as $task)
    <p>{{ $task->name }}</p>
@endforeach

@if($tasks->isEmpty())
    <p>No tasks available.</p>
@endif
```

### **Extend a layout**

```blade
@extends('layouts.app')
@section('content')
    <h1>Dashboard</h1>
@endsection
```

---

## **9. Vite & Tailwind Integration**

### **Development**

```bash
npm install
npm run dev
```

### **Production build**

```bash
npm run build
```

### **Include in Blade**

```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

---

## **10. Artisan Commands (Most Used)**

| Command                                      | Description                      |
| -------------------------------------------- | -------------------------------- |
| `php artisan serve`                          | Start local server               |
| `php artisan migrate`                        | Run DB migrations                |
| `php artisan make:model ModelName`           | Create model                     |
| `php artisan make:controller ControllerName` | Create controller                |
| `php artisan route:list`                     | List all routes                  |
| `php artisan config:clear`                   | Clear config cache               |
| `php artisan cache:clear`                    | Clear cache                      |
| `php artisan view:clear`                     | Clear compiled views             |
| `php artisan optimize`                       | Optimize performance             |
| `php artisan storage:link`                   | Create symbolic link for uploads |

---

## **11. Cache, Queue, and Sessions**

| Function | Default Driver | Location                      |
| -------- | -------------- | ----------------------------- |
| Cache    | file           | `storage/framework/cache/`    |
| Sessions | file           | `storage/framework/sessions/` |
| Queue    | sync           | immediate execution           |

Change in `.env` for Redis or database:

```env
CACHE_DRIVER=redis
SESSION_DRIVER=database
QUEUE_CONNECTION=redis
```

---

## **12. Debugging & Logs**

### **Enable debug mode**

```env
APP_DEBUG=true
```

### **View logs**

```
storage/logs/laravel.log
```

### **Tinker (interactive shell)**

```bash
php artisan tinker
```

---

## **13. Optimization for Production**

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
composer install --no-dev --optimize-autoloader
npm run build
```

---

## **14. Deployment Checklist**

1. Set `APP_ENV=production` and `APP_DEBUG=false`
2. Run `composer install --no-dev`
3. Run `npm run build`
4. Migrate DB → `php artisan migrate --force`
5. Clear and rebuild caches:

   ```bash
   php artisan optimize:clear
   php artisan optimize
   ```
6. Ensure correct permissions for `storage/` and `bootstrap/cache/`

   ```bash
   chmod -R 775 storage bootstrap/cache
   ```
7. Serve via Nginx or Apache, pointing to `/public` directory.

---

## **15. Security Notes**

* Never expose `.env` file publicly.
* Always set correct file permissions.
* Use CSRF protection (`@csrf` in forms).
* Sanitize user input or use Eloquent bindings.
* Keep dependencies updated (`composer update`).

---

## **16. Common Issues**

| Problem                    | Likely Fix                                                |
| -------------------------- | --------------------------------------------------------- |
| Styles not loading         | Run `npm run dev` and include `@vite()`                   |
| 500 error after deployment | Run `php artisan config:clear && php artisan cache:clear` |
| Database not found         | Check `.env` and run `php artisan migrate`                |
| File upload error          | Run `php artisan storage:link`                            |
| Wrong timezone             | Set `APP_TIMEZONE=Asia/Manila` in `.env`                  |

---
