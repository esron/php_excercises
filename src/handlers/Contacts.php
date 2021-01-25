<?php

declare(strict_types=1);

namespace Handlers;

use Components\Auth;
use Components\Database;

class Contacts extends Handler
{
    public function handle(): string
    {
        if (Auth::userIsAuthenticated() === false) {
            return (new Login)->handle();
        }

        $user = Auth::getUser();

        $contacts = Database::instance()->getOwnContacts($user->getId());

        $formError = [];
        $formData = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formError = $this->processForm();

            if (!$formError) {
                $this->requestRedirect('/contacts');
                return '';
            }
        }

        if (!empty($_GET['edit'])) {
            $formData = Database::instance()->getOwnContactById($user->getId(), (int)$_GET['edit']);
        }

        if (!empty($_GET['delete'])) {
            Database::instance()->deleteOwnContactById(
                $user->getId(),
                (int)$_GET['delete']
            );
            $this->requestRedirect('/contacts');
            return '';
        }

        return (new \Components\Template('contacts'))->render([
            'formData' => $formData,
            'formError' => $formError,
            'contacts' => $contacts,
        ]);
    }

    private function processForm(): ?array
    {
        $formError = null;

        $formName = trim($_POST['name'] ?? '');
        $formEmail = trim($_POST['email'] ?? '');
        $formPhone = trim($_POST['phone'] ?? '');
        $formAddress = trim($_POST['address'] ?? '');

        if (!$formName) {
            $formError['name'] = 'The name is mandatory.';
        } elseif (strlen($formName) < 2) {
            $formError['name'] = 'At least two characters are required
            for name.';
        }

        if (!filter_var($formEmail, FILTER_VALIDATE_EMAIL)) {
            $formError['email'] = 'The email is invalid.';
        }

        if (!$formError) {
            if (!empty($_POST['id']) && ($contactId = (int)$_POST['id'])) {
                Database::instance()->updateContact(
                    $contactId,
                    Auth::getUser()->getId(),
                    $formName,
                    $formEmail,
                    $formPhone,
                    $formAddress
                );
            } else {
                $stmt = Database::instance()->addContact(
                    Auth::getUser()->getId(),
                    $formName,
                    $formEmail,
                    $formPhone,
                    $formAddress
                );

                var_dump($stmt);
            }
        }

        return $formError;
    }
}
