<?php

namespace FreshPHP\Singleton;

abstract class Singleton implements ISingleton {

    /**
     * @var array Instance container
     */
    private static $instances = array();

    /**
     * Get instance of self
     * @return Singleton|mixed class instance
     */
    public static final function getInstance() {
        $class = get_called_class();
        if (!isset(self::$instances[$class]) || !is_object(self::$instances[$class])) {
            $rc = new \ReflectionClass($class);
            self::$instances[$class] = $rc->newInstanceArgs(func_get_args());
        }
        return self::$instances[$class];
    }

    /**
     * Destruct class instance
     * @param string $className name of the class
     * @return bool
     */
    public static final function destroy($className) {
        if (isset(self::$instances[$className])) {
            self::$instances[$className] = null;
            return true;
        }
        return false;
    }

}