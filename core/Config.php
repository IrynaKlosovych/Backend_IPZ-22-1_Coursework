<?php

namespace core;

/**
 * @property string $dbHost
 * @property string $dbName
 * @property string $dbLogin
 * @property string $dbPassword
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $error404
 * @property string $error403
 */
class Config
{
    protected array $params;
    protected static Config $instance;

    private function __construct()
    {
        $directory = 'config';
        $configFiles = scandir($directory);
        foreach ($configFiles as $configFile) {
            if (str_ends_with($configFile, '.php')) {
                $path = $directory . '/' . $configFile;
                include($path);
            }
        }
        $this->params = [];

        /** @var array $Config */
        foreach ($Config as $config) {
            foreach ($config as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public static function getInstance(): Config
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