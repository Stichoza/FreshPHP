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

try {
    LocaleTransfer::setLocale(
        Request::getDir(
            (int) ConfigFileHandler::getInstance()->getParam("framework", "mvc", "locale_index")
        )
    );
    MVCRouter::getController()->main();
} catch (Exception $e) {
    if ($e instanceof NoIndexRouteException || $e instanceof UndefinedControllerException) {
        $errorController = new ErrorController();
        $errorController->main(array(
            "code" => ((int) Request::getVariable("_http_error_code") > 0)
                    ? (int) Request::getVariable("_http_error_code") : 404,
            "data" => array(
                "exception" => get_class($e),
                "message" => $e->getMessage()
            )
        ));
    } else {
        $exceptionMessage = $e->getMessage();
        trigger_error(get_class($e) . ((empty($exceptionMessage))
                ? "" : " - " . $exceptionMessage), E_USER_ERROR);
    }
}
exit;