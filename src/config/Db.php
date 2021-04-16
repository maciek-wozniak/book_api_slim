<?php

namespace App\config;

use PDO;

class Db {
    private static $instance = null;

    private static $host = 'localhost';
    private static $dbName = 'xxx';
    private static $dbUser = 'xxx';
    private static $dbPass = 'xxx';

    private function __construct(){}
    private function __clone(){}

    /**
     * @return PDO
     */
    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new PDO("mysql:host=" . static::$host . ";dbname=" . static::$dbName . ";", static::$dbUser, static::$dbPass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            static::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return static::$instance;
    }

}