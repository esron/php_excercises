<?php

declare(strict_types=1);

namespace Components;

use Handlers\Handler;
use Handlers\Login;
use Handlers\Logout;
use Handlers\Profile;
use Handlers\Support;
use Handlers\SignUp;

class Router
{
    public function getHandler(): ?Handler
    {
        switch ($_SERVER['PATH_INFO'] ?? '/') {
            case '/login':
                return new Login();
            case '/signup':
                return new SignUp();
            case '/profile':
                return new Profile();
            case '/logout':
                return new Logout();
            case '/support':
                return new Support();
            case '/':
                return null;
            default:
                return new class extends Handler
                {
                    public function handle(): string
                    {
                            $this->requestRedirect('/');
                            return '';
                    }
                };
        }
    }
}
