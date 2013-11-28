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
        if (!class_exists("V", false))
            class_alias("FreshPHP\\MVC\\View\\Init\\ViewParameterStorage", "V");
        if (!class_exists("L", false))
            class_alias("FreshPHP\\Config\\LocaleTransfer", "L");
        if (!class_exists("R", false))
            class_alias("FreshPHP\\HTTP\\Request", "R");
        include "res/html/" . $filename; // TODO output contents of non-php files
    }

    /*
     * TODO implement addScript(name, loadInHead, async)
     * TODO implement addStyle(name, media)
     * TODO implement addTitle(title)
     * TODO implement rest shit
     */

} 