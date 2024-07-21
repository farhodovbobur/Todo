<?php

require "vendor/autoload.php";

date_default_timezone_set("Asia/Tashkent");

$update = json_decode(file_get_contents('php://input'));

if (isset($update)) {
    require 'bot/bot.php';
    return;
}

if (count($_POST) > 0 || count($_GET) > 0) {
    $todo = new Todo();

    if (isset($_POST["text"])) {
        $todo->add($_POST["text"]);
    }

    if (isset($_GET["checked"])) {
        $todo->checking($_GET["checked"]);
    }

    if (isset($_GET["unchecked"])) {
        $todo->unchecking($_GET["unchecked"]);
    }

    if (isset($_GET["delete"])) {
        $todo->delete($_GET["delete"]);
    }
}

require 'view/view.php';