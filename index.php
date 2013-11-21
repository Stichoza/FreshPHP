<?php

require_once "src/FreshPHP/Igniter.php";

new FreshPHP\Igniter();

FreshPHP\MVC\MVCRouter::getController()->main();