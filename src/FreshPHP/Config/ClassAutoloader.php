<?php

namespace FreshPHP\Config;

/**
 * Initial class for getting framework in working state
 * @package FreshPHP
 * @author Stichoza <me@stichoza.com>
 */
class ClassAutoloader {

    const CLASSPATH = "src";

    /**
     * Register class autoloader
     * @return bool
     */
    public static function register() {
        try {
            $loader = spl_autoload_register(__NAMESPACE__ . '\\ClassAutoloader::classAutoload', true, true);
        } catch (\Exception $e) {
            $loader = false;
        }
        return $loader;
    }

    /**
     * Autoloader method
     * @param $className
     * @throws \Exception
     */
    public static function classAutoload($className) {
        $filename = self::CLASSPATH;
        foreach (explode("\\", $className) as $part) {
            $filename .= "/" . $part;
        }
        $filename .= ".php";
        if (!file_exists($filename)) {
            throw new \Exception("Class file does not exist ($filename)");
        } elseif (!is_readable($filename)) {
            throw new \Exception("Class file is not readable ($filename)");
        } else {
            require_once $filename;
        }
    }

} 