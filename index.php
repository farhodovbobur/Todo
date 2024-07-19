<?php

require_once "vendor/autoload.php";

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