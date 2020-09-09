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

        return (new \Components\Template('support'))->render([
            'username' => $_SESSION['username'],
        ]);
    }

    public function getTitle(): string
    {
        return 'Support - ' . parent::getTitle();
    }
}
