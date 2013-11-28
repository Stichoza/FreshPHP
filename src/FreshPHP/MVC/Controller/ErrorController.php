<?php

namespace FreshPHP\MVC\Controller;

use FreshPHP\HTTP\Request;
use FreshPHP\MVC\Controller\Init\AbstractController;
use FreshPHP\MVC\Controller\Init\IController;
use FreshPHP\MVC\View\ErrorView;

/**
 * Class ErrorController
 * @package FreshPHP\MVC\Controller
 * @author Stichoza <me@stichoza.com>
 */
class ErrorController extends AbstractController implements IController {

    private $errorCode = 0;

    private $errorData = array();

    #Implement
    public function __construct() {
        $this->model = null;
        $this->view = new ErrorView();
    }

    #Implement
    public function main(array $argv = array()) {
        // populate array
        $this->errorCode = $argv["code"];
        $this->errorData["time"] = time();
        $this->errorData["data"] = $argv["data"];
        $this->errorData["error"]["code"] = $this->errorCode;
        $this->errorData["error"]["message"] = Request::getErrorMessage($this->errorCode);
        $this->errorData["vars"]["server"] = $_SERVER;
        $this->errorData["vars"]["post"] = $_POST;
        $this->errorData["vars"]["get"] = $_GET;
        $this->errorData["vars"]["session"] = $_SESSION;


        $this->view->setParam("error_code", $this->errorCode);
        $this->view->setParam("error_message", Request::getErrorMessage($this->errorCode));
        $this->view->setParam("monkey_script", self::monkeyHash($this->errorData));
        $this->view->render();
    }

    public static final function monkeyHash(array $associativeArray) {
        $out = json_encode($associativeArray);
        $out = base64_encode($out);
        $out = str_replace("=", "", $out);
        $out = strrev($out);
        $out = wordwrap($out, 64, "\r\n");
        return $out;
    }

}