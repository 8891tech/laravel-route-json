<?php
namespace T8891\RouteJson;

use Illuminate\Support\ServiceProvider;

class RouteJsonServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $configPath = __DIR__ . '/../config/routejson.php';
        $this->publishes(array($configPath => $this->configPath()));
    }

    public function register()
    {
        $configPath = __DIR__ . '/../config/routejson.php';
        $this->mergeConfigFrom($configPath, 'routejson');
        $this->app->singleton('command.route.json', function ($app) {
            return new Console\RouteJsonCommand();
        });

        $this->commands(array('command.route.json'));
    }

    public function configPath()
    {
        return base_path().'/config/routejson.php';
    }
}