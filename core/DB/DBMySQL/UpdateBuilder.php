<?php

namespace core\DB\DBMySQL;

use core\DB\DBInterfaces\IUpdate;
use core\DB\DBinterfaces\whereInterfaces\ISQLQueryBuilderUDWhere;
use stdClass;

class UpdateBuilder extends BaseBuilder implements IUpdate, ISQLQueryBuilderUDWhere
{
    use WhereTrait;
    protected function reset(): void
    {
        $this->query = new stdClass();
        $this->query->params = [];
        $this->query->queryParts = [];
        $this->query->columns=[];
    }
    protected function getQuery(): stdClass
    {
        return $this->query;
    }
    public function update(string $table, array $fields): ISQLQueryBuilderUDWhere
    {
        $this->query->queryParts['update'] = "Update $table SET";
        $this->generateKeys($fields);
        foreach ($fields as $key=>$value){
            $this->query->columns[] = "$key = :$key";
        }
        return $this;
    }

    public function buildAndExecute(): int
    {
        $queryArr = [$this->query->queryParts['update']];
        $setString=implode(", ", $this->query->columns);
        $queryArr[] = $setString;
        $queryArr[] = $this->buildWhere();
        $querySQL = implode(" ", array_filter($queryArr));
        $sth = $this->pdo->prepare($querySQL);
        foreach ($this->query->params as $param => $value) {
            $sth->bindValue($param, $value);
        }
        $sth->execute();
        return $sth->rowCount();
    }
}