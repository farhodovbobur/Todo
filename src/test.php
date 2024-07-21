<?php
require 'DB.php';
require 'Users.php';

$action = new Users();

$list = $action->getUser(939524628);

foreach ($list as $user) {
    var_dump ($user['id']);
    var_dump ($user['action'] . "\n");
}

var_dump($list);




