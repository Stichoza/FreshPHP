<?php

namespace FreshPHP\Singleton;

abstract class Singleton implements ISingleton {

    private static $instances = array();

    public static final function getInstance() {
        $class = get_called_class();
        if (empty(self::$instances[$class])) {
            $rc = new \ReflectionClass($class);
            self::$instances[$class] = $rc->newInstanceArgs(func_get_args());
        }
        return self::$instances[$class];
    }

} 