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

        if ($_SERVER['REQUEST_METHOD'] === 'POST'
            && isset($_POST['do'])
            && $_POST['do'] === 'get-support'
        ) {
            $formErrors = $this->processContactForm($_POST);

            $formName    = $_POST['name']    ?? '';
            $formEmail   = $_POST['email']   ?? '';

            if (!count($formErrors)) {
                $this->requestRefresh();
                return '';
            }
        }

        return (new \Components\Template('support'))->render([
            'username'  => $_SESSION['username'],
            'formName'  => $formName  ?? '',
            'formEmail' => $formEmail ?? '',
            'formError' => $formErrors ?? null,
            'sentForms' => $_SESSION['sentForms'] ?? [],
            'formCsrfToken' => $this->getCsrfToken(),
        ]);
    }

    public function getTitle(): string
    {
        return 'Support - ' . parent::getTitle();
    }

    private function processContactForm(array $data): ?array
    {
        list($form, $errors) = $this->validateForm($data);

        if (!count($errors)) {
            $_SESSION['sentForms'][] = [
                'dateAdded' => date('Y-m-d'),
                'timeAdded' => date(DATE_COOKIE),
                'form' => $form,
            ];
        }

        return $errors;
    }

    private function validateForm(array $data): array
    {
        $errors = [];

        if (!isset($data['csrf-token'])
            || $data['csrf-token'] !== $this->getCsrfToken()) {
            $errors['form'] = 'Invalid token, please refresh the page and try again.';
        } elseif (($_SESSION['userLevel'] === 'standard')
            && $this->hasSentFormToday($_SESSION['sentForms'] ?? [])
        ) {
            $errors['form'] = 'You are only allowed to send one form per day.';
        }

        $name = trim($data['name'] ?? '');

        if (empty($name)) {
            $errors['name'] = 'Please tell us your name.';
        }

        if (empty($data['email'] ?? '')) {
            $errors['email'] = 'We need your email to make contact.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'The email address is invalid.';
        }

        $message = trim($data['message'] ?? '');

        if (!$message) {
            $errors['message'] = 'Tell us what is going on.';
        }

        $form = [
            'name' => $name,
            'email' => $data['email'],
            'message' => $message,
        ];

        return [$form, $errors];
    }

    private function getCsrfToken(): string
    {
        if (!isset($_SESSION['csrf-token'])) {
            $_SESSION['csrf-token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf-token'];
    }

    private function hasSentFormToday(array $sentForms): bool
    {
        $today = date('Y-m-d');

        foreach ($sentForms as $sentForm) {
            if ($sentForm['dateAdded'] === $today) {
                return true;
            }
        }

        return false;
    }

    private function requestRefresh()
    {
        $this->requestRedirect($_SERVER['REQUEST_URI']);
    }
}
