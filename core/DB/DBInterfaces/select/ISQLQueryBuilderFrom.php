<?php
namespace core\DB\DBInterfaces\select;
//FROM may follow after select or aggregation functions
interface ISQLQueryBuilderFrom{
    public function from(string $table): ISQLQueryBuilderAnotherForSelect;
}