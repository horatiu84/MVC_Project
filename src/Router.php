<?php

/**
 * Class that will take care of the routing and all the routes in the project
 */
class Router
{
    /**
     * The routes that we can have
     * @var array
     */
    private array $routes = [];

    /**
     * Method to add new routes
     * @param string $path the path of the route
     * @param array $params the controller and the action
     * @return void
     */

    public function add(string $path, array $params):void
    {
        $this->routes[] = [
            "path" => $path,
            "params" => $params
        ];
    }

    /**
     * Method that will match the url path with existing routes
     * @param string $path of the url
     * @return array|bool
     */
    public function match(string $path):array|bool
    {
        foreach ($this->routes as $route) {
            if ($route["path"] === $path) {
                return $route['params'];
            }
        }
        return false;
    }
}