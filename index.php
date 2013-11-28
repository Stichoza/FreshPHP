<?php
require_once "src/FreshPHP/Config/ClassAutoloader.php";

use FreshPHP\MVC\MVCRouter;
use FreshPHP\Config\ClassAutoloader;

ClassAutoloader::register() || die("Cannot register autoloader");

try {
    MVCRouter::getController()->main();
} catch (Exception $e) {
    $exceptionMessage = $e->getMessage();
    trigger_error(get_class($e) . ((empty($exceptionMessage))
        ? "" : " - " . $exceptionMessage), E_USER_ERROR);
}

exit();