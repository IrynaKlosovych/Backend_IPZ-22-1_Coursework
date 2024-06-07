<?php

namespace core\DB\DBMySQL\MySqlSelect;

use core\DB\DBInterfaces\select\IAggregateFunctions;
use core\DB\DBInterfaces\select\ISelect;
use core\DB\DBInterfaces\select\ISQLQueryBuilderAnotherForSelect;
use core\DB\DBInterfaces\select\ISQLQueryBuilderFrom;
use core\DB\DBInterfaces\whereInterfaces\ISQLQueryBuilderWhere;
use core\DB\DBMySQL\BaseBuilder;
use core\DB\DBMySQL\WhereTrait;
use PDO;
use stdClass;

class SelectBuilder extends BaseBuilder implements ISelect, ISQLQueryBuilderFrom, ISQLQueryBuilderWhere,
    IAggregateFunctions, ISQLQueryBuilderAnotherForSelect
{
    use WhereTrait;
    use AggregateFunctionsTrait;
    use HavingTrait;

    protected function reset(): void
    {
        $this->query = new stdClass();
        $this->query->selectColumns = [];
        $this->query->queryParts = [];
        $this->query->havingClauses = [];
        $this->query->params = [];
    }

    protected function getQuery(): stdClass
    {
        return $this->query;
    }

    public function select(array $columns): IAggregateFunctions|ISQLQueryBuilderFrom
    {
        $this->query->selectColumns = array_merge($this->query->selectColumns, $columns);
        return $this;
    }

    public function from(string $table): ISQLQueryBuilderAnotherForSelect
    {
        $this->query->queryParts['from'] = "FROM $table";
        return $this;
    }

    public function join($table, $condition, $typeJoin = "JOIN"): ISQLQueryBuilderAnotherForSelect
    {
        $this->query->queryParts['join'][] = "$typeJoin $table ON $condition";
        return $this;
    }

    public function groupBy($columns): ISQLQueryBuilderAnotherForSelect
    {
        $this->query->queryParts['group_by'] = "GROUP BY " . implode(', ', $columns);
        return $this;
    }

    public function orderBy($columns, $direction): ISQLQueryBuilderAnotherForSelect
    {
        $this->query->queryParts['order_by'] = "ORDER BY " . implode(', ', $columns) . " $direction";
        return $this;
    }

    public function limit($number): ISQLQueryBuilderAnotherForSelect
    {
        $this->query->queryParts['limit'] = "LIMIT $number";
        return $this;
    }

    public function buildAndExecute(): array|false
    {
        $this->query->queryParts['where'] = $this->buildWhere();
        $this->query->queryParts['having'] = $this->buildHaving();

        $selectPart = "SELECT " . implode(', ', $this->query->selectColumns);
        $queryArr = [$selectPart];
        foreach (['from', 'join', 'where', 'group_by', 'having', 'order_by', 'limit'] as $part) {
            if (isset($this->query->queryParts[$part])) {
                if (is_array($this->query->queryParts[$part])) {
                    $queryArr = array_merge($queryArr, $this->query->queryParts[$part]);
                } else {
                    $queryArr[] = $this->query->queryParts[$part];
                }
            }
        }
        $querySQL = implode(' ', array_filter($queryArr));

        $statement = $this->pdo->prepare($querySQL);

        foreach ($this->query->params as $param => $value) {
            $statement->bindValue($param, $value);
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}