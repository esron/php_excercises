<?php

declare(strict_types=1);

namespace Components;

class Database
{
    private $pdo;
    private $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=php_exercises;charset=utf8mb4';
    private $options = [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    private function __construct()
    {
        $this->pdo = new PDO($this->dsn, 'php-user', 'php-pass', $this->options);
    }

    public static function instance()
    {
        static $instance;
        if (is_null($instance)) {
            $instance = new static;
        }
        return $instance;
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
