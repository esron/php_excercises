<?php

declare(strict_types=1);

namespace Handlers;

class Contacts extends Handler
{
    public function handle(): string
    {
        if (!array_key_exists('username', $_SESSION)) {
            return (new Login)->handle();
        }

        return (new \Components\Template('contacts'))->render();
    }
}
