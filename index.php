<?php

require "vendor/autoload.php";

date_default_timezone_set("Asia/Tashkent");

$update = json_decode(file_get_contents('php://input'));

$router = new Router();

if ($router->isApiCall()) {
    echo $router->isApiCall();
    require 'api/api.php';
    return;
}

if ($router->isTelegramUpdate()) {
    require 'bot/bot.php';
    return;
}

require 'web/web.php';
