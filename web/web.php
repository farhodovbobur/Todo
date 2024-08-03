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

Router:: get('/', fn() => require 'view/pages/home.php');

Router:: get('/todos', fn() => require 'view/pages/view.php');
Router:: get('/notes', fn() => require 'view/pages/notes.php');
Router:: get('/login', fn() => require 'view/pages/auth/login.php');
Router:: get('/register', fn() => require 'view/pages/auth/register.php');
Router:: get('/logout', fn() => (new Users())->logout());
Router:: post('/register', fn() => (new Users())->register());
Router:: post('/login', fn() => (new Users())->login());
