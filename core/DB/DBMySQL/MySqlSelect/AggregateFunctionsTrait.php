<?php

namespace core\DB\DBMySQL\MySqlSelect;

trait AggregateFunctionsTrait
{
    public function sum(string $column, string $alias): self
    {
        $this->getQuery()->selectColumns[] = "SUM($column) AS $alias";
        return $this;
    }

    public function avg(string $column, string $alias): self
    {
        $this->getQuery()->selectColumns[] = "AVG($column) AS $alias";
        return $this;
    }

    public function min(string $column, string $alias): self
    {
        $this->getQuery()->selectColumns[] = "MIN($column) AS $alias";
        return $this;
    }

    public function max(string $column, string $alias): self
    {
        $this->getQuery()->selectColumns[] = "MAX($column) AS $alias";
        return $this;
    }

    public function count(string $column, string $alias): self
    {
        $this->getQuery()->selectColumns[] = "COUNT($column) AS $alias";
        return $this;
    }
}