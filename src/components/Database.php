<?php

declare(strict_types=1);

namespace Components;

class Database
{
    private $pdo;

    private function __construct()
    {
        $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=php_exercises;charset=utf8mb4';

        $options = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        $this->pdo = new PDO($dsn, 'php-user', 'php-pass', $options);
    }

    public static function instance()
    {
        static $instance;

        if (is_null($instance)) {
            $instance = new static;
        }

        return $instance;
    }

    public function addUser(string $username, string $password): PDOStatement
    {
        $stmt = $this->pdo->prepare("INSERT INTO users ('username', 'password') values (:user, :pass)");

        $stmt->execute([
            ':user' => $username, ':pass' => password_hash($password, PASSWORD_BCRYPT),
        ]);

        return $stmt;
    }
}
