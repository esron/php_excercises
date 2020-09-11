<?php

declare(strict_types=1);

namespace Handlers;

class Login extends Handler
{
    public function handle(): string
    {
        if (isset($_SESSION['username'])) {
            $this->requestRedirect('/');
            return '';
        }

        $users = [
            'admin' => [
                'passwordHash' => '$2y$10$Y09UvSz2tQCw/454Mcuzzuo8ARAjzAGGf8OPGeBloO7j47Fb2v.lu', // 'admin' hash
                'level' => 'VIP',
            ],
            'john' => [
                'passwordHash' => '$2y$10$GTNLIHbPT2PMBZ6ReNgZNuU1g4jL2bo9UZp2O1ONIuYEXJs/7XH5m',
                // '123456' hash
                'level' => 'standard',
            ],
        ];

        $formError = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formUsername = $_POST['username'] ?? '';
            $formPassword = $_POST['password'] ?? '';

            if (!key_exists($formUsername, $users)) {
                $formError = ['username' => sprintf('The username [%s] was not found.', $formUsername)];
            } elseif (!password_verify($formPassword, $users[$formUsername]['passwordHash'])) {
                $formError = ['password' => 'The provided password is invalid.'];
            } else {
                $_SESSION['username'] = $formUsername;
                $_SESSION['userLevel'] = $users[$formUsername]['level'];
                $_SESSION['loginTime'] = date(\DATE_COOKIE);

                $this->requestRedirect('/profile');
                return '';
            }
        }

        return (new \Components\Template('login-form'))->render([
            'formError' => $formError,
            'formUsername' => $formUsername ?? '',
        ]);
    }
}
