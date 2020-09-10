<?php

declare(strict_types=1);

namespace Handlers;

class Support extends Handler
{
    public function handle(): string
    {
        if (!array_key_exists('username', $_SESSION)) {
            return (new Login)->handle();
        }

        $formError = [];
        $formName = '';
        $formEmail = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formName    = $_POST['name']    ?? '';
            $formEmail   = $_POST['email']   ?? '';
            $formMessage = $_POST['message'] ?? '';
            var_dump($_POST['name']);
            if ($formName === '') {
                $formError = array_merge($formError, ['name' => 'Please tell us your name']);
            }

            if ($formEmail === '') {
                $formError = array_merge($formError, ['email' => 'We need your email to make contact']);
            }

            if ($formMessage === '') {
                $formError = array_merge($formError, ['message' => 'Tell us what is going on']);
            }
        }

        return (new \Components\Template('support'))->render([
            'username'  => $_SESSION['username'],
            'formName'  => $formName,
            'formEmail' => $formEmail,
            'formError' => $formError,
        ]);
    }

    public function getTitle(): string
    {
        return 'Support - ' . parent::getTitle();
    }
}
