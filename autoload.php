<?php
function autoload($class): void
{
    $path = str_replace("\\", '/', $class) . '.php';
    if (is_file($path)) {
        require_once("$path");
    }
}