<?php

declare(strict_types=1);

namespace Components;

use Handlers\Contacts;
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
            case '/contacts':
                return new Contacts();
            case '/':
                return new class extends Handler
                {
                    public function handle(): string
                    {
                        if (isset($_SESSION['username'])) {
                            $this->requestRedirect('/profile');
                        }

                        return (new Template('home'))->render();
                    }
                };
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
