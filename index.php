<?php
require_once "src/FreshPHP/Config/ClassAutoloader.php";

use FreshPHP\Config\ClassAutoloader;
use FreshPHP\Config\ConfigFileHandler;
use FreshPHP\Config\LocaleTransfer;
use FreshPHP\HTTP\Request;
use FreshPHP\MVC\MVCRouter;
use FreshPHP\MVC\Exception\NoIndexRouteException;
use FreshPHP\MVC\Exception\UndefinedControllerException;
use FreshPHP\MVC\Controller\ErrorController;

session_start();
ClassAutoloader::register() || die("Cannot register autoloader");
error_reporting((Request::getVariable("debug")) ? E_ALL : 0);

$lDir = (int) ConfigFileHandler::getInstance()->getParam("framework", "mvc", "locale_index");
if ($lDir >= 0 && (Request::getDir($lDir) == "" || Request::getDir($lDir) == null)) {
    Request::redirect(
        (Request::getSessionVar("locale", "%s", false))
            ? ConfigFileHandler::getInstance()->getParam("framework", "mvc", "default_locale")
            : Request::getSessionVar("locale")
    );
}

try {
    LocaleTransfer::setLocale(
        Request::getDir(
            (int) ConfigFileHandler::getInstance()->getParam("framework", "mvc", "locale_index")
        )
    );
    MVCRouter::getController()->main();
} catch (Exception $e) {
    $errorController = new ErrorController();
    $errorData = array();
    $exception = explode("\\", get_class($e));
    switch ($exception[count($exception)-1]) {
        case "NoIndexRouteException":
        case "UndefinedControllerException":
            $errorData["code"] = 404;
            break;
        case "Exception":
        default:
            $errorData["code"] = 400;
            break;
    }
    $errorData["data"] = array(
        "exception" => get_class($e),
        "message" => $e->getMessage()
    );
    $errorController->main($errorData);
}
exit;