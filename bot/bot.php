<?php

declare(strict_types=1);

$bot = new Bot();
$task = new Todo();
$user = new Users();

if (isset($update->message)) {
    $message = $update->message;
    $chat_id = $message->chat->id;
    $text = $message->text;
    $user_name = $message->chat->username;
    $miid =$message->message_id;
    $name = $message->from->first_name;
    $fromid = $message->from->id;
    $photo = $message->photo ?? '';
    $video = $message->video ?? '';
    $audio = $message->audio ?? '';
    $voice = $message->voice ?? '';
    $reply = $message->reply_markup ?? '';

    switch ($text) {
        case '/start':
            $user->addUser($chat_id, $text);
            $bot->hendleStartCommand($chat_id, $user_name);
            return;
        case '/add':
            $user->setAction($chat_id, $text);
            $bot->hendleAddCommand($chat_id);
            return;
        case '/show':
            $user->setAction($chat_id, $text);
            $bot->showAllTasks($chat_id);
            return;
        case '/help':
            $bot->hendleHelpCommand($chat_id);
            return;
        case '/delete':
            $taskId = $user->getUser($chat_id);
            $task->delete($taskId[0]['task_id']);
            $bot->showAllTasks($chat_id);
            return;

        default:
            $action = $user->getUser($chat_id);
            if ($action[0]['action'] == '/add') {
                $bot->addTask($chat_id, $text);
                $user->setAction($chat_id, '/start');
                return;
            }
            if ($action[0]['action'] == 'edit') {
                $bot->editTask($chat_id, $action[0]['task_id'], $text);
                $user->setAction($chat_id, '/start');
                return;
            }
            break;
    }
}

if (isset($update->callback_query)) {
    $callback_query = $update->callback_query;
    $callback_data = $callback_query->data;
    $chat_id = $callback_query->message->chat->id;
    $message_id = $callback_query->message->message_id;

    switch ($callback_data) {
        case '/add':
            $user->setAction($chat_id, $callback_data);
            $bot->hendleAddCommand($chat_id);
            return;
        case '/show':
            $user->setAction($chat_id, $callback_data);
            $bot->showAllTasks($chat_id);
            return;
        case 'done':
            $taskId = $user->getUser($chat_id);
            $task->checking($taskId[0]['task_id']);
            $bot->showAllTasks($chat_id, $message_id, "The Task successfully checked\n\n");
            return;
        case 'not_done':
            $taskId = $user->getUser($chat_id);
            $task->unchecking($taskId[0]['task_id']);
            $bot->showAllTasks($chat_id, $message_id, "The Task successfully unchecked\n\n");
            return;
        case 'delete':
            $taskId = $user->getUser($chat_id);
            $task->delete($taskId[0]['task_id']);
            $bot->showAllTasks($chat_id, $message_id, "The Task successfully deleted\n\n");
            return;
        case 'edit':
            $user->setAction($chat_id, $callback_data);
            $taskId = $user->getUser($chat_id);
            $bot->hendleAddCommand($chat_id);
            return;
        case 'back':
            $bot->showAllTasks($chat_id, $message_id);
            return;

        default:
            $user->setTaskId($chat_id, (int)$callback_data);
            $bot->showTask($chat_id, (int)$callback_data, $message_id);


            break;
    }

}