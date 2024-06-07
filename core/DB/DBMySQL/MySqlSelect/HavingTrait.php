<?php

namespace core\DB\DBMySQL\MySqlSelect;

use core\DB\DBInterfaces\select\ISQLQueryBuilderAnotherForSelect;

trait HavingTrait {

    public function having($column, $operator, $value, $boolean = 'AND'): ISQLQueryBuilderAnotherForSelect {
        $paramKey = ':having_' . count($this->getQuery()->params);
        $clause = "$column $operator $paramKey";
        $this->getQuery()->params[$paramKey] = $value;

        if (empty($this->getQuery()->havingClauses)) {
            $this->getQuery()->havingClauses[] = $clause;
        } else {
            $this->getQuery()->havingClauses[] = "$boolean $clause";
        }
        return $this;
    }
    private function buildHaving(): string {
        if (empty($this->getQuery()->havingClauses)) {
            return '';
        }
        $having = implode(' ', $this->getQuery()->havingClauses);
        return "HAVING $having";
    }
}