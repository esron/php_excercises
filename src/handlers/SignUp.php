<?php

declare(strict_types=1);

namespace Handlers;

use Components\Auth;
use Components\Database;

class SignUp extends Handler
{
    public function handle(): string
    {
        if (Auth::userIsAuthenticated()) {
            $this->requestRedirect('/profile');
            return '';
        }

        $formError = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formError = $this->handleSignUp();

            if ($formError === null) {
                return '';
            }
        }

        return (new \Components\Template('signup-form'))->render([
            'formError' => $formError,
            'formUsername' => $_POST['username'] ?? '',
        ]);
    }

    private function handleSignUp(): ?array
    {
        $formError = null;

        $formUsername = trim($_POST['username'] ?? '');

        $formPassword = trim($_POST['password'] ?? '');

        $formPasswordVerify = trim($_POST['password_verify'] ?? '');

        if (!$formUsername || strlen($formUsername) < 3) {
            $formError = ['username' => 'Please enter an username of at least 3 characters.'];
        } elseif (!ctype_alnum($formUsername)) {
            $formError = ['username' => 'The username should contain only numbers and letters.'];
        }

        if (!$formPassword) {
            $formError = ['password' => 'Please enter a password of at least 6 characters.'];
        } elseif ($formPassword !== $formPasswordVerify) {
            $formError = ['password' => 'The passwords doesn\'t match.'];
        }

        if (!$formError) {
            $stmt = Database::instance()->addUser(strtolower($formUsername), $formPassword);

            if (!$stmt->rowCount()) {
                list(,, $error) = $stmt->errorInfo();
                $formError = ['username' => $error];
            } else {
                Auth::authenticate((int)Database::instance()->getPdo()->lastInsertId());
                $this->requestRedirect('/profile');
            }
        }

        return $formError;
    }
}
