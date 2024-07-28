<?php

declare(strict_types=1);

$router = new Router();

if ($router->isApiCall()) {
    require 'api/api.php';
    return;
}

if ($router->isTelegramUpdate()) {
    require 'bot/bot.php';
    return;
}

require 'web/web.php';
