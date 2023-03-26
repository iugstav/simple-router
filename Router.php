<?php
namespace Iugstav\Router;

require_once "exceptions/RouteNotFoundException.php";
require_once "exceptions/NotFoundException.php";

class Router
{
    public array $routes;

    private function addHandler(string $path, string $method, callable |array $handler): void
    {
        $this->routes[$path] = [
            'path' => ($path[0] === '/') ? $path : "/" . $path,
            'method' => $method,
            'handler' => $handler
        ];
    }

    public function get(string $path, callable |array $handler): void
    {
        $this->addHandler($path, "GET", $handler);
    }

    public function run(): mixed
    {
        $phpRequestUri = $_SERVER["REQUEST_URI"];

        $routePath = explode('?', $phpRequestUri)[0];
        $routeHandler = $this->routes[$routePath]["handler"];

        if (!$routeHandler) {
            require_once "views/404.php";
            throw new \Iugstav\Exceptions\RouteNotFoundException();

        }

        if (is_callable($routeHandler)) {
            return call_user_func($routeHandler);
        } else if (is_array($routeHandler)) {
            [$class, $method] = $routeHandler;

            if (!class_exists($class)) {
                throw new \Iugstav\Exceptions\NotFoundException($class);
            }

            $controllerClass = new $class();
            if (!method_exists($controllerClass, $method)) {
                throw new \Iugstav\Exceptions\NotFoundException("$class->$method");
            }

            return call_user_func_array([$controllerClass, $method], []);
        }

        throw new \Iugstav\Exceptions\RouteNotFoundException();
    }
}