<?php

declare(strict_types=1);

$task = new Todo();
$router = new Router();

//$_SESSION['error'] = null;

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

$router->get('/', fn() => require 'view/pages/home.php');

$router->get('/todos', fn() => require 'view/pages/view.php');
$router->get('/notes', fn() => require 'view/pages/notes.php');
$router->get('/login', fn() => require 'view/pages/auth/login.php');
$router->get('/register', fn() => require 'view/pages/auth/register.php');
$router->post('/register', fn() => (new Users())->register());
$router->post('/login', fn() => (new Users())->login());

//require 'view/view.php';
