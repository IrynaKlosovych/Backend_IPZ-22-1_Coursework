<?php

namespace core\DB\DBinterfaces\whereInterfaces;

use core\DB\DBInterfaces\ISQLQueryBuilderBuild;

//where for update and delete don't have another functions such limit, order by and so on
interface ISQLQueryBuilderUDWhere extends ISQLQueryBuilderWhere, ISQLQueryBuilderBuild
{
}