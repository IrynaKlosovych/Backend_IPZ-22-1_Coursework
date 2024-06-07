<?php

namespace core\DB\DBInterfaces\select;

interface ISelect
{
    public function select(array $columns): IAggregateFunctions|ISQLQueryBuilderFrom;
}