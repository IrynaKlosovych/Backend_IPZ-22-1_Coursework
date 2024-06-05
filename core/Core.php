<?php

namespace core;

class Core
{
    public string $defaultLayoutPath='views/layouts/index.php';
    public string $moduleName;
    public string $actionName;
    public Router $router;
    public Template $template;
    public $db;
    public $session;
    private static $instance;
    private function __construct(){
        $this->template = new Template($this->defaultLayoutPath);
        $dbHost = Config::getInstance()->dbHost;
        $dbName =Config::getInstance()->dbName;
        $dbLogin =Config::getInstance()->dbLogin;
        $dbPassword =Config::getInstance()->dbPassword;
        $this->db=new DataBase($dbHost, $dbName, $dbLogin, $dbPassword);
        $this->session = new Session();
        session_start();
    }

    public function run($route){
        $this->router = new Router($route);
        $params=$this->router->run();
        if(!empty($params))
            $this->template->setParams($params);
    }

    public function done(){
        $this->template->display();
        //$this->router->done();
    }
    public static function getInstance(){
        if(empty(self::$instance))
            self::$instance = new Core();
        return self::$instance;
    }
}