<?php

namespace FreshPHP\MVC\View\Init;

/**
 * Class ViewParameterStorage
 * @package FreshPHP\MVC\View\Init
 * @author Stichoza <me@stichoza.com>
 */
class ViewParameterStorage {

    private static $data = array();

    /**
     * @param $key
     * @param $value
     * @throws \Exception
     */
    public static final function set($key, $value) {
        if (!is_string($key))
            throw new \Exception("Key must me a string");
        self::$data[$key] = $value;
    }

    /**
     * @param string $key Key name
     * @param mixed $default Default value
     * @return mixed
     */
    public static final function get($key, $default = null) {
        if (!isset(self::$data[$key]))
            return $default;
        return self::$data[$key];
    }

} 