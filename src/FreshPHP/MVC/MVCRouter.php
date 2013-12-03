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

        if (!isset($requestArray[intval($mvc["start_index"])])) {
            $controllerClassName = $routePath["."];
        } else {
            for ($i = intval($mvc["start_index"]); $i < count($requestArray)+1; $i++) {
                if (!$routePath = self::getRequestChild($requestArray[$i], $routePath)) {
                    throw new UndefinedControllerException("Controller for this request is not defined");
                }
                if (is_string($routePath)) {
                    $controllerClassName = $routePath;
                    break;
                }
                if (!isset($requestArray[$i+1])) {
                    if (isset($routePath["."])) {
                        $controllerClassName = $routePath["."];
                        break;
                    } else {
                        throw new NoIndexRouteException("Route has no index controller defined");
                    }
                }
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
                return !!preg_match('/^[A-Za-z0-9-_]+$/', $dirName);
            default:
                if (substr_count($routeString, "/")) {
                    return !!preg_match($routeString, $dirName);
                } else {
                    return ($routeString == $dirName);
                }
        }
    }

    /**
     * @param string $dirName
     * @param array $routeArray
     * @return bool
     */
    public static final function getRouteChild($dirName, array $routeArray) {
        foreach ($routeArray as $key => $value) {
            if (self::matchRequestDir($dirName, $key)) {
                return $value;
            }
        }
        return false;
    }

} 