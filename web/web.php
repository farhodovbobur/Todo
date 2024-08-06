<?php

declare(strict_types=1);

Router:: get('/', fn() => require 'view/pages/home.php');
Router:: get('/notes', fn() => require 'view/pages/notes.php');

Router:: get('/todos', fn() => require 'view/pages/view.php');
Router:: get('/todos/delete', fn() => (new Todo())->delete((int)$_GET['id']) ,fn() => require 'view/pages/view.php');
Router:: get('/todos/checked', fn() => (new Todo())->checking((int)$_GET['id']) ,fn() => require 'view/pages/view.php');
Router:: get('/todos/unchecked', fn() => (new Todo())->unchecking((int)$_GET['id']) ,fn() => require 'view/pages/view.php');

Router:: post('/todos', fn() => (new Todo())->add(1, $_POST['text']), fn() => require 'view/pages/view.php');

Router:: get('/login', fn() => require 'view/pages/auth/login.php');
Router:: post('/login', fn() => (new Users())->login());

Router:: get('/register', fn() => require 'view/pages/auth/register.php');
Router:: post('/register', fn() => (new Users())->register());

Router:: get('/logout', fn() => (new Users())->logout());

Router:: notFound();