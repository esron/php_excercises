<?php

declare(strict_types=1);

namespace Handlers;

use Components\Auth;
use Components\Database;

class Login extends Handler
{
    public function handle(): string
    {
        if (Auth::userIsAuthenticated()) {
            $this->requestRedirect('/profile');
            return '';
        }

        $formError = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formError = $this->handleLogin();

            if ($formError === null) {
                return '';
            }
        }

        return (new \Components\Template('login-form'))->render([
            'formError' => $formError,
            'formUsername' => $_POST['username'] ?? '',
        ]);
    }

    private function handleLogin(): ?array
    {
        $formError = null;

        $formUsername = $_POST['username'] ?? '';

        $formPassword = $_POST['password'] ?? '';

        if (!$formUsername) {
            $formError['username'] = 'Please enter a username.';
        }

        if (!$formPassword) {
            $formError['password'] = 'Please enter a password.';
        }

        if (!$formError) {
            $user = Database::instance()->getUserByUsername($formUsername);

            if (!$user) {
                $formError['username'] = sprintf('The username [%s] was not found.', $formUsername);
            } elseif (!$user->passwordMatches($formPassword)) {
                $formError['password'] = 'The provided password is invalid';
            } else {
                Auth::authenticate((int) $user->getId());

                $this->requestRedirect('/profile');
            }
        }

        return $formError;
    }
}
