<?php

declare(strict_types=1);

use GuzzleHttp\Client;

class Bot
{
    public string $tgApi;
    public Client $client;
    public Todo $task;

    public function __construct(string $token)
    {
        $this->tgApi = "https://api.telegram.org/bot$token/";
        $this->client = new Client(['base_uri'=>$this->tgApi]);
        $this->task = new Todo();
    }

    public function sendMessage(int $chatId, string $message, $replyMarkup = null): void
    {
        $this->client->post('sendMessage',[
            'form_params'=>[
                'chat_id'=>$chatId,
                'text'=>$message,
                'reply_markup'=>$replyMarkup
            ]
        ]);
    }

    public function editMessageText(int $chatId, int $messageId, string $message, $replyMarkup = null): void
    {
        $this->client->post('editMessageText',[
            'form_params'=>[
                'chat_id'=>$chatId,
                'message_id'=>$messageId,
                'text'=>$message,
                'reply_markup'=>$replyMarkup
            ]
        ]);
    }

    public function hendleStartCommand(int $chatId, string $userName): void
    {
        $message = "Hello @$userName. Welcome to TODO telegram bot.";

        $keyboard = json_encode([
            'inline_keyboard'=>[
                [
                    ['text' => 'Add task', 'callback_data' => '/add']
                ]
            ]
        ]);

        $this->sendMessage($chatId, $message, $keyboard);
    }

    public function hendleAddCommand(int $chatId): void
    {
        $message = "Please, enter a task.";

        $this->sendMessage($chatId, $message);
    }

    public function hendleHelpCommand(int $chatId): void
    {
        $message = "
        /start - Start bot\n/add - Create a new task\n/show - Show all tasks\n/delete - Delete task\n/help - Show help message";

        $this->sendMessage($chatId, $message);
    }

    public function addTask(int $chatId, string $text): void
    {
        $this->task->add($chatId, $text);

        $message = "The Task successfully added.";

        $keyboard = json_encode([
            'inline_keyboard'=>[
                [
                    ['text' => 'Add task', 'callback_data' => '/add'],
                    ['text' => 'Show tasks', 'callback_data' => '/show']
                ]
            ]
        ]);

        $this->sendMessage($chatId, $message, $keyboard);
    }

    public function editTask(int $chatId, int $taskId, string $text): void
    {
        $this->task->updateText($taskId, $text);

        $message = "The Task successfully updated.\n\n";

        $this->showAllTasks($chatId, messageId: null, act: $message);
    }

    public function showAllTasks(int $chatId, int $messageId = null, string $act = null): void
    {
        $tasksList = $this->task->getOneUserId($chatId);
        $keyboard = ['inline_keyboard'=>[]];

        if (count($tasksList)){
            foreach ($tasksList as $task){
                $status = $task['status'] ? "✅ " : "⬜️ ";
                $dot = str_repeat(".", 100);
                $text = "$status {$task['text']} $dot";
                $keyboard['inline_keyboard'][] = [['text' => "$text", 'callback_data' => $task['id']]];
            }

//            if (count($tasksList) > 10){
//                $keyboard['inline_keyboard'][] = [['text' => '◀️', 'callback_data' => 'prev'],['text' => '▶️', 'callback_data' => 'next']];
//            }

            $keyboard['inline_keyboard'][] = [['text' => 'Add task', 'callback_data' => '/add']];

            $keyboards = json_encode($keyboard);
            $message = $act . "Your tasks\n";

            if (is_numeric($messageId)){
                $this->editMessageText($chatId, $messageId, $message, $keyboards);
                return;
            }
            $this->sendMessage($chatId, $message, $keyboards);
        } else {
            $message = "Sorry, no tasks were found.";
            $keyboard = json_encode([
                'inline_keyboard'=>[
                    [
                        ['text' => 'Add task', 'callback_data' => '/add']
                    ]
                ]
            ]);
            $this->sendMessage($chatId, $message, $keyboard);
        }
    }

    public function showTask(int $chatId, int $taskId, int $messageId): void
    {
        $curent_task = $this->task->getId($taskId);
        $status = $curent_task[0]['status'] ? "⬜️ Not Done" : "✅ Done";
        $action = $curent_task[0]['status'] ? "not_done" : "done";

        $message = "Task # \n\n" . $curent_task[0]['text'];

        $keyboard = json_encode([
            'inline_keyboard'=>[
                [
                    ['text' => $status, 'callback_data' => $action],
                    ['text' => "📝 Edit", 'callback_data' => 'edit'],
                    ['text' => "🗑 Delete", 'callback_data' => 'delete'],
                ],
                [
                    ['text' => "⬅️ Go Back", 'callback_data' => 'back'],
                ]
            ]
        ]);

        $this->editMessageText($chatId, $messageId, $message, $keyboard);
    }
}