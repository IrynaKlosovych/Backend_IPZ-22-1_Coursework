<?php

namespace core;
class Router
{
    protected string $route;

    public function __construct($route)
    {
        $this->route = $route;
    }

    public function run()
    {
        $parts = explode('/', $this->route);
        Core::getInstance()->moduleName=$parts[0];
        Core::getInstance()->actionName=$parts[1];
        $controller = "controllers\\" . ucfirst($parts[0]) . "Controller";
        $method = "action" . ucfirst($parts[1]);
        if (!class_exists($controller) || !method_exists($controller, $method)) {
            $this->error(404);
            return;
        }
        array_splice($parts, 0, 2);
        $controllerObject = new $controller();
        return $controllerObject->$method($parts);
    }

    public function done()
    {

    }

    public function error($code): void
    {
        http_response_code($code);
        echo $code;
    }
}