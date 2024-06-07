<?php

namespace core\DB\DBMySQL;

use core\DB\DBInterfaces\IInsert;
use core\DB\DBInterfaces\ISQLQueryBuilderBuild;
use stdClass;

class InsertBuilder extends BaseBuilder implements IInsert
{
    protected function reset(): void
    {
        $this->query = new stdClass();
        $this->query->params = [];
    }

    public function insert(string $table, array $fields): ISQLQueryBuilderBuild
    {
        $fieldsList = implode(',', array_keys($fields));
        $this->query->queryParts['insert'] = "INSERT " . "INTO $table (".$fieldsList.") VALUES";
        $this->generateKeys($fields);
        return $this;
    }

    public function buildAndExecute():int
    {
        $paramsList = implode(',', array_keys($this->query->params));
        $queryArr = [$this->query->queryParts['insert']];
        $queryArr[] ="(".$paramsList.")";
        $querySQL = implode(" ", array_filter($queryArr));

        $sth = $this->pdo->prepare($querySQL);
        foreach ($this->query->params as $param => $value) {
            $sth->bindValue($param, $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }
}