<?php

namespace core\DB\DBMySQL;

use core\DB\DBInterfaces\select\ISelect;
use core\DB\DBMySQL\MySqlSelect\SelectBuilder;
use core\DB\DBInterfaces\IDelete;
use core\DB\DBInterfaces\IInsert;
use core\DB\DBInterfaces\IUpdate;
use PDO;

class DataBaseMySQL
{
    public PDO $pdo;

    public function __construct($dbHost, $dbName, $dbLogin, $dbPassword)
    {
        $this->pdo = new PDO("mysql:host=$dbHost; dbname=$dbName", $dbLogin, $dbPassword,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
    }

    public function createSelect(): ISelect
    {
        return new SelectBuilder($this->pdo);
    }

    public function createDelete(): IDelete
    {
        return new DeleteBuilder($this->pdo);
    }

    public function createInsert(): IInsert
    {
        return new InsertBuilder($this->pdo);
    }

    public function createUpdate(): IUpdate
    {
        return new UpdateBuilder($this->pdo);
    }
}