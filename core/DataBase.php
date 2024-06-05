<?php

namespace core;

class DataBase
{
    public $pdo;
    public function  __construct($dbHost, $dbName, $dbLogin, $dbPassword){
        $this->pdo= new \PDO("mysql:host={$dbHost}; dbname={$dbName}", $dbLogin, $dbPassword,
        [
            \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC
        ]);
    }
    protected function where($where){
        if(is_array($where)){
            $whereString = "WHERE ";
            $whereFields = array_keys($where);
            $whereValues = array_values($where);
            $parts=[];
            foreach ($whereFields as $field){
                $parts []="{$field}= :{$field}";
            }
            $whereString .= implode('AND', $parts);
        }
        else if(is_string($where))
            $whereString=$where;
        else
            $whereString="";
        return $whereString;
    }
    public function select($table, $fields="*", $where=null){
        if(is_array($fields))
            $fieldsString = implode(',', $fields);
        else if(is_string($fields))
            $fieldsString = $fields;
        else $fieldsString ="*";
        $whereString=$this->where($where);
        $sql = "SELECT {$fieldsString} FROM {$table} {$whereString}";
        $sth=$this->pdo->prepare($sql);
        foreach ($where as $key=>$value)
            $sth->bindValue(":{$key}", $value);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function insert($table, $rowToInsert){
        $fieldsList = implode(',', array_keys($rowToInsert));
        $paramsArray = [];
        foreach ($rowToInsert as $key=>$value){
            $paramsArray [] = ":{$key}";
        }
        $paramsList = implode(',', $paramsArray);
        $sql = "INSERT INTO {$table} ($fieldsList) VALUES ({$paramsList})";
        $sth=$this->pdo->prepare($sql);
        foreach ($rowToInsert as $key=>$value)
            $sth->bindValue(":{$key}", $value);
        $sth->execute();
        return $sth->rowCount();
    }
    public function update($table, $rowToUpdate, $where){
        $whereString = $this->where($where);
        $setArray = [];
        foreach ($rowToUpdate as $key=>$value){
            $setArray [] = "{$key} = :{$key}";
        }
        $setString=implode(", ", $setArray);
        $sql = "UPDATE {$table} SET {$setString} {$whereString}";

        $sth=$this->pdo->prepare($sql);
        foreach ($where as $key=>$value)
            $sth->bindValue(":{$key}", $value);
        foreach ($rowToUpdate as $key=>$value)
            $sth->bindValue(":{$key}", $value);
        $sth->execute();
        return $sth->rowCount();
    }
    public function delete($table, $where){
        $whereString=$this->where($where);
        $sql = "DELETE FROM {$table} {$whereString}";
        $sth=$this->pdo->prepare($sql);
        foreach ($where as $key=>$value)
            $sth->bindValue(":{$key}", $value);
        $sth->execute();
        return $sth->rowCount();
    }
}