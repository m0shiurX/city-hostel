## Installation Steps

1. Install project dependencies using Composer:

```shell
composer install
```

2. Create a `.env` file by copying the example:

```shell
cp .env.example .env
```

3. Generate a unique application key:

```shell
php artisan key:generate
```

4. Create a SQLite database:

```shell
touch database/database.sqlite
```

5. Run migrations and seed the database:

```shell
php artisan migrate:fresh --seed
```

6. Create a symbolic link for storage:

```shell
php artisan storage:link
```

7. Start the development server:

```shell
php artisan serve
```

8. Open your browser and go to [http://127.0.0.1:8000](http://127.0.0.1:8000) to access the application.
