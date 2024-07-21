<?php

class Users
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function addUser(int $chat_id, string $action): bool
    {
        $check = $this->pdo->query("SELECT * FROM users WHERE user_id={$chat_id}")->fetch();
        if (!$check) {
            $user = $this->pdo->prepare("INSERT INTO users (user_id, action) VALUES (:user_id, :action)");
            $user->bindParam(':user_id', $chat_id);
            $user->bindParam(':action', $action);
            return $user->execute();
        }

        return $this->setAction($chat_id, $action);
    }

    public function setAction(int $chat_id, string $action): bool
    {
        $user = $this->pdo->prepare("UPDATE users SET action = :action WHERE user_id = :user_id");
        $user->bindParam(':user_id', $chat_id);
        $user->bindParam(':action', $action);

        return $user->execute();
    }

    public function getUser(int $chat_id): array
    {
        return $this->pdo->query("SELECT * FROM users WHERE user_id={$chat_id}")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setTaskId(int $chat_id, int $task_id): bool
    {
        $user = $this->pdo->prepare("UPDATE users SET task_id = :task_id WHERE user_id = :user_id");
        $user->bindParam(':user_id', $chat_id);
        $user->bindParam(':task_id', $task_id);

        return $user->execute();
    }

}