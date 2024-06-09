<?php

namespace core\RequestMethods;

class RequestMethod
{
    public array $array;
    public function __construct($array)
    {
        $this->array=$array;
    }

    public function __get($name){
        return $this->array[$name];
    }
    public function getAll():array{
        return $this->array;
    }
}