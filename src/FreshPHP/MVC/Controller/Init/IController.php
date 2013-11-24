<?php

namespace FreshPHP\MVC\Controller\Init;

/**
 * Class IController
 * @package FreshPHP\MVC\Controller\Init
 * @author Stichoza <me@stichoza.com>
 */
interface IController {

    public function main(array $argv = array());

    public function __construct();

} 