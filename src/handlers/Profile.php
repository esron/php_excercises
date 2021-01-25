<?php

declare(strict_types=1);

namespace Handlers;

use Components\Auth;

class Profile extends Handler
{
    public function handle(): string
    {
        if (!Auth::userIsAuthenticated()) {
            return (new Login)->handle();
        }

        $user = Auth::getUser();

        return (new \Components\Template('profile'))->render([
            'username' => $user->getUsername(),
            'signUpDate' => $user->getSignupTime()->format(DATE_RSS),
            'loginTime' => Auth::getLastLogin()->format(DATE_RSS),
        ]);
    }

    public function getTitle(): string
    {
        return 'Profile - ' . parent::getTitle();
    }
}
