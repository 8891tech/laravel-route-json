<?php
namespace T8891\RouteJson\Console;

use Illuminate\Console\Command;

class RouteJsonCommand extends Command
{
    protected $name = 'route:json';

    protected $signature = 'route:json
                               {--o|output= : Specify the json file save path}
                           ';

    protected $description = 'Export all registered routes to a json file';

    public function fire()
    {
        $output_path = $this->option('output') ?: base_path().'/public';
        $routeCollection = $this->laravel ? $this->laravel->getRoutes() : $this->app->getRoutes();

        $routeJson = array();
        foreach($routeCollection as $route) {
            $routeJson[] = array(
                'path' => $route['uri']
            );
        }
        file_put_contents($output_path.'/route.json', json_encode($routeJson, JSON_UNESCAPED_SLASHES));
    }
}
