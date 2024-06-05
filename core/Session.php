<?php

namespace core;

class Session
{
    public function set(string $name, $value): void
    {
        $_SESSION["name"] = $value;
    }
    public function remove($name){
        unset($_SESSION[$name]);
    }
    public function setValues($assocArray){
        foreach($assocArray as $key=>$value){
            $this->set($key, $value);
        }
    }
    public function get(string $name)
    {
        return $_SESSION["name"];
    }
}