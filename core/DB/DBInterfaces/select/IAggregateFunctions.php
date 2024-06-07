<?php

namespace core\DB\DBInterfaces\select;

//I need aggregation functions. they will help me
interface IAggregateFunctions
{
    public function sum(string $column, string $alias): self;

    public function avg(string $column, string $alias): self;

    public function min(string $column, string $alias): self;

    public function max(string $column, string $alias): self;

    public function count(string $column, string $alias): self;
}