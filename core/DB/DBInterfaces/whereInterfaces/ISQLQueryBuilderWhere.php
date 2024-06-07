<?php

namespace core\DB\DBinterfaces\whereInterfaces;

interface ISQLQueryBuilderWhere{
    public function where(string $column, string $operator, string $value, string $boolean = 'AND'):self;
    public function orWhere(string $column, string $operator, string $value):self;

    public function andWhere(string $column, string $operator, string $value):self;

    public function whereNot(string $column, string $operator, string $value, string $boolean = 'AND'):self;
    public function beginGroup(string $boolean):self;

    public function endGroup():self;
}