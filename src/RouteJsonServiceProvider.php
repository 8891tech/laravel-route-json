<?php
namespace T8891\RouteJson;

use Illuminate\Support\ServiceProvider;

class RouteJsonServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('command.route.json', function ($app) {
            return new Console\RouteJsonCommand();
        });

        $this->commands(array('command.route.json'));
    }
}