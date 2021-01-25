<?php

declare(strict_types=1);

namespace Handlers;

use Components\Auth;

class Contacts extends Handler
{
    public function handle(): string
    {
        if (Auth::userIsAuthenticated() === false) {
            return (new Login)->handle();
        }

        return (new \Components\Template('contacts'))->render([
            'contacts' => $contacts,
        ]);
    }
}
