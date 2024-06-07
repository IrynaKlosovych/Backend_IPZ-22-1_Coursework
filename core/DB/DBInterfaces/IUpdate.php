<?php

namespace core\DB\DBInterfaces;

use core\DB\DBinterfaces\whereInterfaces\ISQLQueryBuilderUDWhere;

interface IUpdate
{
    public function update(string $table, array $fields): ISQLQueryBuilderUDWhere;
}