<?php

declare(strict_types=1);

if (count($_GET) > 0) {

    if (isset($_GET["checked"])) {
        (new Todo())->checking((int)$_GET["checked"]);
    }

    if (isset($_GET["unchecked"])) {
        (new Todo())->unchecking((int)$_GET["unchecked"]);
    }

    if (isset($_GET["delete"])) {
        (new Todo())->delete((int)$_GET["delete"]);
    }

    require 'view/pages/view.php';
}

Router:: get('/', fn() => require 'view/pages/home.php');
Router:: get('/notes', fn() => require 'view/pages/notes.php');

Router:: get('/todos', fn() => require 'view/pages/view.php');

Router:: post('/todos', fn() => (new Todo())->add(1, $_POST['text']), fn() => require 'view/pages/view.php');

Router:: get('/login', fn() => require 'view/pages/auth/login.php');
Router:: post('/login', fn() => (new Users())->login());

Router:: get('/register', fn() => require 'view/pages/auth/register.php');
Router:: post('/register', fn() => (new Users())->register());

Router:: get('/logout', fn() => (new Users())->logout());

Router:: notFound();