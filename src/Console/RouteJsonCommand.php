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
        $routes = $this->isLumen() ? $this->app->getRoutes() : \Route::getRoutes();

        $routeJson = array();
        foreach($routes as $route) {
            $path = method_exists($route, 'uri') ? $route->uri() : $route['uri'];
            if ($path[0]!='/') $path = '/'.$path;
            $path = preg_replace('/{[^}]+}/', '[^/]+', $path);
            $routeJson[] = array(
                'path' => $path
            );
        }

        $extra = $this->app['config']->get('routejson.extra');
        if (is_array($extra) && count($extra)) {
            foreach($extra as $route) {
                $routeJson[] = array('path' => $route);
            }
        }

        file_put_contents($output_path.'/route.json', json_encode($routeJson, JSON_UNESCAPED_SLASHES));
    }

    protected function isLumen()
    {
        if (!property_exists($this, 'app')) {
            $this->app = $this->laravel;
        }
        $versionMethod = 'version';
        if (!method_exists($this->app, $versionMethod)) {
            $versionMethod = 'getVersion';
        }
        return str_contains($this->app->{$versionMethod}(), 'Lumen');
    }
}
