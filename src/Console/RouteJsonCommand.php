<?php
namespace T8891\RouteJson\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class RouteJsonCommand extends Command
{
    protected $name = 'route:json';

    protected $description = 'Export all registered routes to a json file';

    public function __construct()
    {
        parent::__construct();
        $this->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'Specify the json file save path');
    }

    public function fire()
    {
        $output_path = $this->option('output') ?: base_path().'/public';

        $routes = class_exists('\Route') ? \Route::getRoutes() : $this->laravel->getRoutes();

        $routeJson = array();
        foreach($routes as $route) {
            $routeJson[] = array(
                'path' => class_exists('\Route') ? $route->uri() : $route['uri']
            );
        }
        file_put_contents($output_path.'/route.json', json_encode($routeJson, JSON_UNESCAPED_SLASHES));
    }
}
