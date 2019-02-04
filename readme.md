### How to install (use sudo if you need)
```
* chmod 777 -R storage
* chmod 777 -R bootstrap/cache;
* composer install
* cp .env.exemple .env (if haven't)
* php artisan key:generate
* php artisan migrate
* add a virtual machine in your apache with name convenia
```

### Seed
```
* php artisan db:seed
```

### User root
```
user: root@convenia.com
pass: secret
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

### USE
* Swagger is a front client to consume api. Use the method 
login to get token and put this in form authorize.

### About
this code have:
* Framework Laravel
* Register user/company
* Management providers
* Monthlies total of providers
* Validation input
* job monthlies
* Relationships
* Autentication JWT
* Protection data
* SOLID
* Design Patterns
* Swagger (other option like GraphQL)

this code haven't: 
* Cache
* Tests
* GraphQL
* Docker
* provider email comfirmation
* Event Driven 