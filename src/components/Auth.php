<?php

declare(strict_types=1);

namespace Components;

use DateTime;
use Models\User;

class Auth
{
    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['userId']);
    }

    public static function getLastLogin(): DateTime
    {
        return DateTime::createFromFormat('U', (string)($_SESSION['loginTime'] ?? ''));
    }

    public static function getUser(): ?User
    {
        if (self::userIsAuthenticated()) {
            return Database::getUserById((int)$_SESSION['userid']);
        }
        return null;
    }

    public static function authenticate(int $id)
    {
        $_SESSION['userId'] = $id;
        $_SESSION['loginTime'] = time();
    }

    public static function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_regenerate_id(true);
            session_destroy();
        }
    }
}
