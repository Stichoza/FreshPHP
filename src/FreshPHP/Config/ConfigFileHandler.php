<?php

namespace FreshPHP\Config;
use FreshPHP\Singleton\ISingleton as Singleton;

/**
 * Class ConfigFileHandler
 * @package FreshPHP\Config
 * @author Stichoza <me@stichoza.com>
 */
class ConfigFileHandler implements Singleton {

    /**
     * Framework configuration filename. Path relative to index file
     */
    const CONFIG_FILE = "config.json";

    /**
     * @var array $configArray Array containing configuration file data
     */
    protected $configArray = array();

    /**
     * @var ConfigFileHandler $instance Instance of self
     */
    private static $instance;

    /**
     * Class constructor
     * @throws \Exception
     */
    public function __construct() {
        if (!$fileSource = file_get_contents(self::CONFIG_FILE)) {
            throw new \Exception("Error reading configuration file");
        } elseif (!$this->configArray = json_decode($fileSource, true)) {
            throw new \Exception("Invalid JSON");
        }
    }

    /**
     * Get self instance (Singleton)
     * @return ConfigFileHandler
     */
    public function getInstance() {
        if(!is_object(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c();
        }
        return self::$instance;
    }

    /**
     * Get config parameter
     * @return array|mixed
     * @throws \OutOfBoundsException
     * @throws \BadFunctionCallException
     */
    public function getParam(/* $args... */) {
        if (!func_num_args()) {
            throw new \BadFunctionCallException("Parameters not set");
        }
        $param = $this->configArray;
        foreach (func_get_args() as $arg) {
            if (!isset($param[$arg]))
                throw new \OutOfBoundsException("Array key not found");
            $param = $param[$arg];
        }
        return $param;
    }

}