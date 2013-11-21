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

        $routeArray = ConfigFileHandler::getInstance()->getParam("framework", "mvc_route");
        $requestArray = Request::getDirArray();

        // TODO Route request here (get name of controller)

        if (Controller\$controllerClassName instanceof IController) {
            return Controller\$controllerClassName;
        } else {
            throw new \Exception("Controller is not implementing interface IController");
        }

    }

} 