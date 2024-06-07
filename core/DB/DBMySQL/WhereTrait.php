<?php

namespace core\DB\DBMySQL;

trait WhereTrait
{
    private array $whereClauses = [];

    private function generateKey(string $value): string
    {
        $paramKey = ':where_' . count($this->getQuery()->params);
        $this->getQuery()->params[$paramKey] = $value;
        return $paramKey;
    }

    public function where(string $column, string $operator, string $value, string $boolean = 'AND'): self
    {
        $paramKey = $this->generateKey($value);
        $clause = "$column $operator $paramKey";
        if (empty($this->whereClauses)) {
            $this->whereClauses[] = $clause;
        } else {
            $this->whereClauses[] = "$boolean $clause";
        }
        return $this;
    }

    public function orWhere(string $column, string $operator, string $value): self
    {
        return $this->where($column, $operator, $value, 'OR');
    }

    public function andWhere(string $column, string $operator, string $value): self
    {
        return $this->where($column, $operator, $value);
    }

    public function whereNot(string $column, string $operator, string $value, string $boolean = 'AND'): self
    {
        $paramKey = $this->generateKey($value);
        $clause = "NOT $column $operator $paramKey";
        if (empty($this->whereClauses)) {
            $this->whereClauses[] = $clause;
        } else {
            $this->whereClauses[] = "$boolean $clause";
        }
        return $this;
    }

    public function beginGroup(string $boolean): self
    {
        $this->whereClauses[] = "$boolean (";
        return $this;
    }

    public function endGroup(): self
    {
        $this->whereClauses[] = ")";
        return $this;
    }

    private function buildWhere(): string
    {
        if (empty($this->whereClauses)) {
            return '';
        }
        $where = implode(' ', $this->whereClauses);
        return "WHERE $where";
    }
}