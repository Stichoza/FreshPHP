<?php

namespace FreshPHP\MVC\View\Init;

use FreshPHP\MVC\View\Init\ViewParameterStorage as V;

/**
 * Class AbstractView
 * @package FreshPHP\MVC\View\Init
 * @author Stichoza <me@stichoza.com>
 */
abstract class AbstractView {

    abstract public function render();

    public function setParam($key, $value) {
        try {
            V::set($key, $value);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getParam($key, $default = null) {
        return V::get($key, $default);
    }

    public function loadFile($filename) {
        include "res/html/" . $filename; // TODO output contents of non-php files
    }

} 