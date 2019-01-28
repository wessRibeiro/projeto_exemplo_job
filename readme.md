### How to install (use sudo if you need)
```
* chmod 777 -R storage
* chmod 777 -R bootstrap/cache;
* composer install
* cp .env.exemple .env (if haven't)
* php artisan key:generate
* php artisan migrate
```

### Seed
```
* php artisan db:seed
```

### CODE DESCRIPTION
````
| 200  | OK            | 
| 201  | Created       | 
| 400  | Bad Request   | 
| 401  | Unauthorized  |
| 404  | Page not found|
| 500  | Server Error  |
````