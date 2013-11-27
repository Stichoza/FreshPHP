<?php
require_once "src/FreshPHP/Config/ClassAutoloader.php";

use FreshPHP\HTTP\Request;
use FreshPHP\MVC\MVCRouter;

FreshPHP\Config\ClassAutoloader::register() || die("Cannot register autoloader");

try {
    MVCRouter::getController()->main();
} catch (Exception $e) {
    trigger_error(get_class($e), E_USER_ERROR);
}

exit();