# laravel-route-json

Export all route into a json file at public path

Support Laravel & Lumen upper 5.0

## Laravel
```config/app.php```
```php
'providers' => [
    ...
    'T8891\RouteJson\RouteJsonServiceProvider',
]
```


## Lumen
```bootstrap/app.php```
```php
$app->register(T8891\RouteJson\RouteJsonServiceProvider::class);

// OR
$app->register('T8891\RouteJson\RouteJsonServiceProvider');
```
