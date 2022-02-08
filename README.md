# Setup


To get this project running locally first you have to run command:

```
composer update
```

Before running the database migrations you have to setup a database connection in the `.env` file. Then you can run:

```
php artisan key:generate
php artisan migrate --seed
```


