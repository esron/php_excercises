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

        $contacts = [
            [
                'name' => 'Alonzo E Barber',
                'email' => 'alonzo@barber.com',
                'phone' => '818-740-3656',
                'address' => '848 Glendale Avenue Los Angeles California 90017',
            ],
            [
                'name' => 'Annmairie N Reeves',
                'email' => 'annmarie@reeves.com',
                'phone' => '413-626-0746',
                'address' => '3984 Leverton Cove Road Springfield Massachusetts 01109',
            ],
        ];

        return (new \Components\Template('contacts'))->render([
            'contacts' => $contacts,
        ]);
    }
}
