<?php

declare(strict_types=1);

$task = new Todo();

if (count($_POST) > 0 || count($_GET) > 0) {


    if (isset($_POST["text"])) {
        $task->add(1, $_POST["text"]);
    }

    if (isset($_GET["checked"])) {
        $task->checking((int)$_GET["checked"]);
    }

    if (isset($_GET["unchecked"])) {
        $task->unchecking((int)$_GET["unchecked"]);
    }

    if (isset($_GET["delete"])) {
        $task->delete((int)$_GET["delete"]);
    }
}

require 'view/view.php';
