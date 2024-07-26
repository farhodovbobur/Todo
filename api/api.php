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
                $router->sendResponse($view);
                return;
            }
            $router->sendResponse("Please, enter numeric resource id");
            return;
        }
        $view = $task->getAll();
        $router->sendResponse($view);
        return;
    case 'POST':
        $task->add($update->userId, $update->task);
        $router->sendResponse("The resource successfully added.");
        return;
    case 'PATCH':
        if ($task->getId((int)$router->getResourceId()) == null) {
            $router->sendResponse([
                'message' => "Resource id - " . $router->getResourceId() . " does not exist",
                'code' => 404
            ]);
            return;
        }
        $taskId = $task->getId((int)$router->getResourceId());
        if ($taskId[0]['status'] == 1) {
            $task->unchecking((int)$router->getResourceId());
            $router->sendResponse([
                'message' => "The resource successfully deleted.",
            ]);
            return;
        }
        $task->checking((int)$router->getResourceId());
        $router->sendResponse([
            'message' => "The resource successfully deleted."
        ]);
        return;
    case 'DELETE':
        if ($task->getId((int)$router->getResourceId()) == null) {
            $router->sendResponse([
                'message' => "Resource id - " . $router->getResourceId() . " does not exist",
                'code' => 404
            ]);
            return;
        }
        $task->delete((int)$router->getResourceId());
        $router->sendResponse([
            'message' => "The resource successfully deleted."
        ]);
        return;
}
