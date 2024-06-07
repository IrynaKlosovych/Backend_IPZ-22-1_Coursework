<?php

namespace core\DB\DBMySQL;

use core\DB\DBinterfaces\whereInterfaces\ISQLQueryBuilderUDWhere;
use core\DB\DBInterfaces\IDelete;
use stdClass;

class DeleteBuilder extends BaseBuilder implements IDelete, ISQLQueryBuilderUDWhere
{
    use WhereTrait;

    protected function reset(): void
    {
        $this->query = new stdClass();
        $this->query->params = [];
        $this->query->queryParts = [];
    }

    protected function getQuery(): stdClass
    {
        return $this->query;
    }

    public function delete(string $table): ISQLQueryBuilderUDWhere
    {
        $this->query->queryParts['delete'] = "DELETE " . "FROM $table";
        return $this;
    }

    public function buildAndExecute(): int
    {
        $queryArr = [$this->query->queryParts['delete']];
        $queryArr[] = $this->buildWhere();
        $querySQL = implode(" ", array_filter($queryArr));

        $statement = $this->pdo->prepare($querySQL);

        foreach ($this->query->params as $param => $value) {
            $statement->bindValue($param, $value);
        }
        $statement->execute();
        return $statement->rowCount();
    }
}