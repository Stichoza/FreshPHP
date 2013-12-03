<?php

namespace FreshPHP\MVC;

use FreshPHP\Config\ConfigFileHandler;
use FreshPHP\HTTP\Request;
use FreshPHP\MVC\Exception\InvalidControllerException;
use FreshPHP\MVC\Exception\NoIndexRouteException;
use FreshPHP\MVC\Exception\UndefinedControllerException;

/**
 * Class MVCRouter
 * @package FreshPHP\MVC
 * @author Stichoza <me@stichoza.com>
 */
class MVCRouter {

    /**
     * Get controller based on HTTP request
     * @param array $args Controller arguments
     * @return object Controller
     * @throws Exception\UndefinedControllerException
     * @throws Exception\InvalidControllerException
     * @throws Exception\NoIndexRouteException
     */
    public static function getController(array $args = array()) {

        $config = ConfigFileHandler::getInstance();
        $mvc = $config->getParam("framework", "mvc");
        $requestArray = Request::getDirArray();

        $routePath = $mvc["route"];
        $controllerClassName = null;

        // TODO think again about this crazy shit
        for ($i = intval($mvc["start_index"]); $i <= count($requestArray); $i++) {
            if ($i == $mvc["start_index"]
                && !isset($requestArray[$i])) {
                $controllerClassName = $routePath["."];
                break;
            } else if (!isset($routePath[$requestArray[$i]])) {
                throw new UndefinedControllerException("Controller for this request is not defined");
            } else if (!isset($requestArray[$i+1])
                || empty($requestArray[$i+1])) {
                if (!is_array($routePath[$requestArray[$i]])
                    && !empty($routePath[$requestArray[$i]])) {
                    $controllerClassName = $routePath[$requestArray[$i]];
                } else if (isset($routePath[$requestArray[$i]]["."])) {
                    $controllerClassName = $routePath[$requestArray[$i]]["."];
                } else {
                    throw new NoIndexRouteException("Route has no index controller defined");
                }
                break;
            } else {
                $routePath = $routePath[$requestArray[$i]];
            }
        }

        $controllerReflection = new \ReflectionClass(__NAMESPACE__ . "\\Controller\\" . $controllerClassName);
        if ($controllerReflection->implementsInterface(__NAMESPACE__ . "\\Controller\\Init\\IController")) {
            return $controllerReflection->newInstance($args);
        } else {
            throw new InvalidControllerException("Controller is not implementing interface IController");
        }

    }

    /**
     * @param string $dirName Directory name from HTTP requesy
     * @param string $routeString Route dir matching string from mvc_route
     * @return bool
     */
    public static final function matchRequestDir($dirName, $routeString) {
        switch ($routeString) {
            case "%123%":
                return !!preg_match('/^[0-9]+$/', $dirName);
            case "%abc%":
                return !!preg_match('/^[a-zA-Z]+$/', $dirName);
            case "%abc123%":
            case "%123abc%":
                return !!preg_match('/^[a-zA-Z0-9]+$/', $dirName);
            case "%any%":
                return !!preg_match('/^[a-zA-Z0-9]+$/', $dirName);
            default:
                if (substr_count($routeString, "/")) {
                    return !!preg_match($routeString, $dirName);
                } else {
                    return ($routeString == $dirName);
                }
        }
    }

} 