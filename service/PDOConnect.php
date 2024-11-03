<?php

class PDOConnect
{
    private static $instances = [];

    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup() {}

    public static function getInstance()
    {
        $class = static::class;
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }

        return self::$instances[$class];
    }

    public function connect()
    {
        return new PDO('mysql:host=localhost:3306;dbname=prods_test', 'prodsT', '123456Qw!', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}