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

    public function login(): void
    {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_email=:email AND user_password=:password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['user'] = $result['user_email'];
            header('location: /');
        } else {
            $_SESSION['error'] = "Wrong email or password";
            header('location: /login');
        }
        exit();
    }

    public function register(): void
    {
        $_SESSION['error'] = null;
        if ($this->isUserExists()) {
            $_SESSION['error'] = "User already exists";
            header('location: /register');

        } else {
            $user = $this->create();
            $_SESSION['user'] = $user['user_email'];
            header('location: /');
        }
        exit();
    }


    public function create()
    {
        if ($_POST['email'] != null && $_POST['password'] != null) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $stmt = $this->pdo->prepare("INSERT INTO users (user_email, user_password) VALUES (:email, :password)");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $user = $this->pdo->prepare("SELECT * FROM users WHERE user_email=:email");
            $user->bindParam(':email', $email);
            $user->execute();
            return $user->fetch(PDO::FETCH_ASSOC);
        }
        $_SESSION['error'] = "Email or password is empty";
        header('location: /register');
        exit();
    }

    public function isUserExists(): bool
    {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_email=:email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return (bool)$stmt->fetch();
        }
        return false;
    }



}