<?php
namespace 8891\RouteJson;

use Illuminate\Support\ServiceProvider;

class RouteJsonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('command.route.json', function ($app) {
            return new Console\RouteJsonCommand();
        });
    }
}
