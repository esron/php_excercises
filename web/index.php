<?php
declare(strict_types=1);

session_start();

require_once __DIR__ . '/../src/components/Router.php';
require_once __DIR__ . '/../src/components/Template.php';
require_once __DIR__ . '/../src/handlers/Contacts.php';
require_once __DIR__ . '/../src/handlers/Handler.php';
require_once __DIR__ . '/../src/handlers/Login.php';
require_once __DIR__ . '/../src/handlers/Logout.php';
require_once __DIR__ . '/../src/handlers/Profile.php';
require_once __DIR__ . '/../src/handlers/SignUp.php';
require_once __DIR__ . '/../src/handlers/Support.php';

$mainTemplate = new \Components\Template('main');

$templateData = [
    'title' => 'PHP Exercises',
];

$router = new \Components\Router();

if ($handler = $router->getHandler()) {
    $content = $handler->handle();

    if ($handler->willRedirect()) {
        return;
    }

    $templateData['content'] = $content;
    $templateData['title'] = $handler->getTitle();
}

echo $mainTemplate->render($templateData);
