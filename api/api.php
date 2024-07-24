<?php

declare(strict_types=1);

$update = json_decode(file_get_contents('php://input'));

$task = new Todo();

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

switch ($path) {
    case '/add':
        $task->add($update->userId, $update->text);
        return;
    case '/show':
        echo json_encode($task->getAll());
        return;
    case '/delete':
        $task->delete($update->taskId);
        return;
    case '/check':
        $task->checking($update->taskId);
        return;
    case '/uncheck':
        $task->unchecking($update->taskId);
        return;
}