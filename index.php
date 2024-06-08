<?php
require_once("autoload.php");
spl_autoload_register("autoload");

$route = $_GET['route'] ?? "";

$core = core\Core::getInstance();
$core->run($route);
$core->done();