<?php

namespace core;

class Model
{
    protected array $fieldsArray;
    protected static string $primaryKey = 'id';
    protected static string $table = '';

    public function __construct()
    {
        $this->fieldsArray = [];
    }

    public function __set(string $name, $value): void
    {
        $this->fieldsArray[$name] = $value;
    }

    public function __get(string $name)
    {
        return $this->fieldsArray[$name]??null;
    }
    public function save(): void
    {
        $value = $this->{static::$primaryKey};
        if (empty($value)) {
            Core::getInstance()->db->createInsert()
                ->insert(static::$table, $this->fieldsArray)
                ->buildAndExecute();
        }
    }
    public static function deleteByID($id): void
    {
        $delete = Core::getInstance()->db->createDelete();
        $delete->delete(static::$table)
            ->where(static::$primaryKey, "=", $id)
            ->buildAndExecute();
    }
}