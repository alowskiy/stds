<?php

use Router\Router;
use Vendor\DBConnection;

spl_autoload_register();

$db = new DBConnection;
$db->connect();
$router = new Router($_SERVER['PATH_INFO']);
$router->checkRoute($_SERVER['PATH_INFO']);

?>