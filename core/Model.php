<?php

namespace core;

class Model
{
    protected $fieldsArray;
    protected static $primaryKey ='id';
    protected static $table='';
    public function __construct()
    {
        $this->fieldsArray=[];
    }

    public function __set(string $name, $value): void
    {
        $this->fieldsArray[$name]=$value;
    }

    public function __get(string $name)
    {
        return $this->fieldsArray[$name];
    }
    public function save()
    {
        $value = $this->{static::$primaryKey};
        if (empty($value)) {
            //insert
            Core::getInstance()->db->insert();
        } else {
            //update
        }
    }
    public static function deleteByID($id){
        Core::getInstance()->db->delete(static::$table, static::$primaryKey);
    }

    public static function deleteByCondition(){

    }

    public static function selectByID(){

    }
}