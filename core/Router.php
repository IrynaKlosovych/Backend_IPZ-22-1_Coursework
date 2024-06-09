<?php

namespace core;
use controllers\ErrorController;

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
        if (strlen($parts[0]) == 0) {
            $parts[0] = 'site';
            $parts[1] = 'index';
        }
        if (count($parts) == 1) {
            $parts[1] = "index";
        }
        Core::getInstance()->moduleName = $parts[0];
        Core::getInstance()->actionName = $parts[1];
        $controller = "controllers\\" . ucfirst($parts[0]) . "Controller";
        $method = "action" . ucfirst($parts[1]);
        if (!class_exists($controller) || !method_exists($controller, $method)) {
            $code=404;
            $this->error($code);
            $errorController = new ErrorController();
            return $errorController->actionError([$code, Config::getInstance()->error404]);
        }
        array_splice($parts, 0, 2);
        $controllerObject = new $controller();
        return $controllerObject->$method($parts);
    }
    public function error($code): void
    {
        http_response_code($code);
    }
}