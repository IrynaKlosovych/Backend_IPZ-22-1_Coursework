<?php
require_once("autoload.php");
spl_autoload_register("autoload");

//core\Config::getInstance();
//die;
$core = core\Core::getInstance();
$core->run($_GET['route']);
$core->done();