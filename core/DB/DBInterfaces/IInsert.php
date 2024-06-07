<?php

namespace core\DB\DBInterfaces;

interface IInsert extends ISQLQueryBuilderBuild
{
    function insert(string $table, array $fields):ISQLQueryBuilderBuild;
}