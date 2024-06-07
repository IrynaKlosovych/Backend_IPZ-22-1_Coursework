<?php
namespace core\DB\DBInterfaces;

//builders for select, update, insert and delete will have different results
interface ISQLQueryBuilderBuild{
    public function buildAndExecute();
}