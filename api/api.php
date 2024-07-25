<?php

declare(strict_types=1);

$update = json_decode(file_get_contents('php://input'));

$router = new Router();
$task = new Todo();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if ($router->getResourceId()) {
            if (is_numeric($router->getResourceId())) {
                $view = $task->getId((int)$router->getResourceId());
                print_r($view);
                return;
            }
            echo "Please, enter numeric resource id";
            return;
        }
        $view = $task->getAll();
        print_r($view);
        return;
    case 'POST':
        echo "Add new resource";
        return;
    case 'PATCH':
        echo "Resource " . $router->getResourceId() . " update";
        return;
    case 'DELETE':
        echo "Resource " . $router->getResourceId() . " delete";
        return;
}
