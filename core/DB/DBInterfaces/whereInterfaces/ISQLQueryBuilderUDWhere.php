<?php

namespace core\DB\DBinterfaces\whereInterfaces;

use core\DB\DBInterfaces\ISQLQueryBuilderBuild;

//where for update and delete don't have another functions such limit, order by and so on
interface ISQLQueryBuilderUDWhere extends ISQLQueryBuilderWhere, ISQLQueryBuilderBuild
{
    public function where(string $column, string $operator, string $value, string $boolean = 'AND'):self;
    public function orWhere(string $column, string $operator, string $value):self;

    public function andWhere(string $column, string $operator, string $value):self;

    public function whereNot(string $column, string $operator, string $value, string $boolean = 'AND'):self;
    public function beginGroup(string $boolean):self;

    public function endGroup():self;
    public function buildAndExecute():int;
}