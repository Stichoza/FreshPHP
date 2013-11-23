<?php

namespace FreshPHP\Config;

/**
 * Initial class for getting framework in working state
 * @package FreshPHP
 * @author Stichoza <me@stichoza.com>
 */
class Igniter {

    const CLASSPATH = "src";

    public function __construct() {
        spl_autoload_register(__NAMESPACE__ . '\Igniter::classAutoload');
    }

    public static function classAutoload($className) {
        $filename = self::CLASSPATH;
        foreach (explode("\\", $className) as $part) {
            $filename .= "/" . $part;
        }
        $filename .= ".php";
        if (!file_exists($filename)) {
            throw new \Exception("Class file does not exist ($filename)");
        }
        require_once $filename;
    }

} 