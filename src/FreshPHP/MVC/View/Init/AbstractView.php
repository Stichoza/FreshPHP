<?php

namespace FreshPHP\MVC\View\Init;

/**
 * Class AbstractView
 * @package FreshPHP\MVC\View\Init
 * @author Stichoza <me@stichoza.com>
 */
abstract class AbstractView {

    abstract public function render();

    public function setParam($key, $value) {
        try {
            ViewParameterStorage::set($key, $value);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getParam($key, $default = null) {
        return ViewParameterStorage::get($key, $default);
    }

    public function loadFile($filename) {
        class_alias("FreshPHP\\MVC\\View\\Init\\ViewParameterStorage", "V");
        class_alias("FreshPHP\\Config\\LocaleTransfer", "L");
        class_alias("FreshPHP\\HTTP\\Request", "R");
        include "res/html/" . $filename; // TODO output contents of non-php files
    }

} 