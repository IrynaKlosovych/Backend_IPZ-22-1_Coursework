<?php

namespace core\DB\DBInterfaces;
use core\DB\DBinterfaces\whereInterfaces\ISQLQueryBuilderUDWhere;

interface IDelete{
    public function delete(string $table): ISQLQueryBuilderUDWhere;
}