<?php

namespace FreshPHP\MVC\Controller;

use FreshPHP\MVC\Controller\Init\AbstractController;
use FreshPHP\MVC\Controller\Init\IController;
use FreshPHP\MVC\Model\DemoModel;
use FreshPHP\MVC\View\DemoView;

/**
 * Class DemoController
 * @package FreshPHP\MVC\Controller
 * @author Stichoza <me@stichoza.com>
 */
class DemoController extends AbstractController implements IController {

    #Implement
    public function __construct() {
        $this->model = new DemoModel();
        $this->view = new DemoView();
    }

    #Implement
    public function main(array $argv = array()) {
        // Controller entry point
        $foo = $this->model->getPageContent();
        $this->view->setParam("content", $foo);
        $this->view->render();
    }

}