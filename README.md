# laravel-route-json

Export all route into a json file (route.json) at public path

route.json format like
```
[
  "path" : "/user",
  "path" : "/user/[^/]+"   # equal route /user/{id}
]
```

Support Laravel & Lumen upper 5.0

## Usage

```bash
composer require 8891/laravel-route-json
```

### Laravel
```config/app.php```
```php
'providers' => [
    ...
    'T8891\RouteJson\RouteJsonServiceProvider',
]
```


### Lumen
```bootstrap/app.php```
```php
$app->register(T8891\RouteJson\RouteJsonServiceProvider::class);

// OR
$app->register('T8891\RouteJson\RouteJsonServiceProvider');
```

### Export route.json
```bash
php artisan route:json
```
then check the public/route.json

## Extra Route Match
```config/routejson.php```
```php
<?php
return [
    "extra" => [
        "/assets"
    ]
];
```
