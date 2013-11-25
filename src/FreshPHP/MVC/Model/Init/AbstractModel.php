<?php

namespace FreshPHP\MVC\Model\Init;
use FreshPHP\Database\MySQL\MysqliDb;

/**
 * Class AbstractModel
 * @package FreshPHP\MVC\Model\Init
 * @author Stichoza <me@stichoza.com>
 */
abstract class AbstractModel {

    protected $sql;

    public function __construct() {
        $this->openConnection();
    }

    public final function openConnection() {
        $this->sql = new MysqliDb(); // TODO add data to constructor
    }
} 