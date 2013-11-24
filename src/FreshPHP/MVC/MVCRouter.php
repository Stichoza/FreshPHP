<?php

namespace FreshPHP\MVC;

use FreshPHP\Config\ConfigFileHandler;
use FreshPHP\HTTP\Request;
use FreshPHP\MVC\Controller\Init\IController;

/**
 * Class MVCRouter
 * @package FreshPHP\MVC
 * @author Stichoza <me@stichoza.com>
 */
class MVCRouter {

    /**
     * Get controller based on HTTP request
     * @param array $args Controller arguments
     * @return mixed
     * @throws \Exception
     */
    public static function getController(array $args = array()) {

        $config = ConfigFileHandler::getInstance();
        $mvc = $config->getParam("framework", "mvc");
        $requestArray = Request::getDirArray();

        // TODO Route request here (get name of controller)
        $controllerClassName = "DemoController";

        $controllerReflection = new \ReflectionClass(__NAMESPACE__ . "\\Controller\\" . $controllerClassName);
        if ($controllerReflection->implementsInterface(__NAMESPACE__ . "\\Controller\\Init\\IController")) {
            return $controllerReflection->newInstance($args);
        } else {
            throw new \Exception("Controller is not implementing interface IController");
        }

    }

} 