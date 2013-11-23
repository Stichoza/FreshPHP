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
     * @return mixed
     * @throws \Exception
     */
    public static function getController() {

        $config = ConfigFileHandler::getInstance();
        $mvc = $config->getParam("framework", "mvc");
        $requestArray = Request::getDirArray();

        // TODO Route request here (get name of controller)
        $controllerClassName = "DemoController";

        if (Controller\$controllerClassName instanceof IController) {
            $cName = "Controller\\" . $controllerClassName;
            return new $cName();
        } else {
            throw new \Exception("Controller is not implementing interface IController");
        }

    }

} 