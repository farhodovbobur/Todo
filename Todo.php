<?php

class Todo
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DB::connect();
    }

    public function add(string $text): bool
    {
        $text = trim($text);

        $status = false;
        $stmt   = $this->pdo->prepare("INSERT INTO todos (text, status) VALUES (:text, :status)");
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    public function getAll(): false|array
    {
        return $this->pdo->query("SELECT * FROM todos")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checking(int $id): bool
    {
        $status = true;
        $stmt = $this->pdo->prepare("UPDATE todos SET status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    public function unchecking(int $id): bool
    {
        $status = false;
        $stmt = $this->pdo->prepare("UPDATE todos SET status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);

        return $stmt->execute();
    }

    public function delete(int $id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM todos WHERE id = :id");
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}