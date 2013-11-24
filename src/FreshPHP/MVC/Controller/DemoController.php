<?php

namespace FreshPHP\MVC\Controller;

use FreshPHP\MVC\Controller\Init\AbstractController;
use FreshPHP\MVC\Controller\Init\IController;

/**
 * Class DemoController
 * @package FreshPHP\MVC\Controller
 * @author Stichoza <me@stichoza.com>
 */
class DemoController extends AbstractController implements IController {

    #Implement
    public function __construct() {
        $this->model = null;
        $this->view = null;
    }

    #Implement
    public function main(array $argv = array()) {
        echo "DemoController::main() YOLO!";
        // Controller entry point
    }

}