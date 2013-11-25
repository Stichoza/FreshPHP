<?php
require_once "src/FreshPHP/Config/ClassAutoloader.php";
FreshPHP\Config\ClassAutoloader::register();

FreshPHP\MVC\MVCRouter::getController()->main();