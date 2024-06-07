<?php

namespace core\DB\DBInterfaces\select;

use core\DB\DBInterfaces\ISQLQueryBuilderBuild;
use core\DB\DBinterfaces\whereInterfaces\ISQLQueryBuilderWhere;

//It is another which follow after FROM
interface ISQLQueryBuilderAnotherForSelect extends ISQLQueryBuilderBuild, ISQLQueryBuilderWhere
{
    public function join(string $table, string $condition, string $typeJoin = "JOIN"): ISQLQueryBuilderAnotherForSelect;

    public function where(string $column, string $operator, string $value, string $boolean = 'AND'): ISQLQueryBuilderAnotherForSelect;

    public function orWhere(string $column, string $operator, string $value): ISQLQueryBuilderAnotherForSelect;

    public function andWhere(string $column, string $operator, string $value): ISQLQueryBuilderAnotherForSelect;

    public function whereNot(string $column, string $operator, string $value, string $boolean = 'AND'): ISQLQueryBuilderAnotherForSelect;

    public function groupBy(array $columns): ISQLQueryBuilderAnotherForSelect;

    public function beginGroup(string $boolean): ISQLQueryBuilderAnotherForSelect;

    public function endGroup(): ISQLQueryBuilderAnotherForSelect;

    public function having(string $column, string $operator, string $value, string $boolean = 'AND'): ISQLQueryBuilderAnotherForSelect;

    public function orderBy(array $columns, string $direction): ISQLQueryBuilderAnotherForSelect;

    public function limit(int $number): ISQLQueryBuilderAnotherForSelect;
}