<?php

namespace core;

class Session
{
    public function set(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }
    public function remove($name):void{
        unset($_SESSION[$name]);
    }
    public function setValues($assocArray):void{
        foreach($assocArray as $key=>$value){
            $this->set($key, $value);
        }
    }
    public function get(string $name): string|null
    {
        if(empty($_SESSION[$name]))
            return null;
        return $_SESSION[$name];
    }
    public function removeAll():void{
        $_SESSION= array();
        session_destroy();
    }
}