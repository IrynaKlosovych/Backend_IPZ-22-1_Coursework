<?php

namespace core;

class Config
{
    protected $params;
    protected static $instance;

    private function __construct()
    {
        $directory='config';
        $configFiles = scandir($directory);
        foreach ($configFiles as $configFile){
            if(str_ends_with($configFile, '.php')){
                $path = $directory.'/'.$configFile;
                include ($path);
            }
        }
        $this->params = [];
        foreach ($Config as $config){
            foreach ($config as $key=>$value){
                $this->$key=$value;
            }
        }
    }

    public static function getInstance()
    {
        if (empty(self::$instance))
            self::$instance = new self();
        return self::$instance;
    }

    public function __set(string $name, $value): void
    {
        $this->params[$name] = $value;
    }

    public function __get(string $name)
    {
        return $this->params[$name];
    }
}