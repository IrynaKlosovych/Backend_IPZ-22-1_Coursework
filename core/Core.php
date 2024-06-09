<?php

namespace core;

use core\DB\DBMySQL\DataBaseMySQL;

class Core
{
    public string $defaultLayoutPath = 'views/layouts/index.php';
    public string $moduleName;
    public string $actionName;
    public Router $router;
    public Template $template;
    public DataBaseMySQL $db;
    public Session $session;
    private static Core $instance;
    public bool $isError = false;

    private function __construct()
    {
        $this->template = new Template($this->defaultLayoutPath);
        $dbHost = Config::getInstance()->dbHost;
        $dbName = Config::getInstance()->dbName;
        $dbLogin = Config::getInstance()->dbLogin;
        $dbPassword = Config::getInstance()->dbPassword;
        $this->db = new DataBaseMySQL($dbHost, $dbName, $dbLogin, $dbPassword);
        $this->session = new Session();
        session_start();
    }

    public function run($route): void
    {
        $this->router = new Router($route);
        $params = $this->router->run();
        if (!empty($params))
            $this->template->setParams($params);
    }

    public function done(): void
    {
        $this->template->display();
    }

    public static function getInstance(): Core
    {
        if (empty(self::$instance))
            self::$instance = new Core();
        return self::$instance;
    }
}