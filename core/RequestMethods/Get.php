<?php

namespace core\RequestMethods;

class Get extends RequestMethod
{
    public function __construct()
    {
        parent::__construct($_GET);
    }
}