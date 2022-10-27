<?php


namespace App;

use App\Request;
use App\Route;


class Router
{
    protected $routes = [];

    public function __construct($routes = null)
    {
        if($routes !== null) {
            foreach ($routes as $module => $moduleRoutes) {
                foreach ($moduleRoutes as $name => $route) {
                    $this->add(new Route ($name, $route['route'], $route['action']));
                }
            }
        }
    }

    public function add (Route $route) {
        $this->routes[] = $route;
    }

    public function match(Request $request) {
        $url = strtok($request->getUrl(), '?');

        foreach ($this->routes as $route) {
            $route_url = $route->getRoute();

            if ($route_url === $url) {
                return $route;
            }
        }

        throw new \Exception('Route not found.');

    }

}