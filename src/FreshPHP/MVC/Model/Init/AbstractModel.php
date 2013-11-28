<?php

namespace FreshPHP\MVC\Model\Init;
use FreshPHP\Database\MySQL\MysqliDb;
use FreshPHP\Database\CredentialStorage as CS;

/**
 * Class AbstractModel
 * @package FreshPHP\MVC\Model\Init
 * @author Stichoza <me@stichoza.com>
 */
abstract class AbstractModel {

    /**
     * @var MysqliDb database wrapper instance
     */
    protected $sql;

    public function __construct() {
        $this->openConnection();
    }

    public final function openConnection() {
        $this->sql = new MysqliDb(
            CS::DB_HOST,
            CS::DB_USER,
            CS::DB_PASS,
            CS::DB_NAME);
    }
} 