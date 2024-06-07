<?php

namespace core\DB\DBMySQL;

use PDO;
use stdClass;

abstract class BaseBuilder
{
    protected stdClass $query;
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->reset();
    }
    protected function generateKeys(array $fields):void
    {
        foreach ($fields as $key => $value) {
            $this->query->params[":$key"] = $value;
        }
    }
    protected abstract function reset():void;
}