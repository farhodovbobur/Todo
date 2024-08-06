<?php

class Router
{
    public mixed $updates;

    public function __construct()
    {
        $this->updates = json_decode(file_get_contents('php://input'));
    }

    public function isApiCall(): int|string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = explode('/', $uri);
        return array_search('api', $path);
    }

    public function getResourceId(): float|false|int|string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = explode('/', $uri);
        return end($path);
    }

    public function isTelegramUpdate(): bool
    {
        if (isset($this->updates->update_id)) {
            return true;
        }
        return false;
    }

    public function sendResponse($message): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($message);
    }

    public function getUpdates()
    {
        return $this->updates;
    }

    public static function get($path, $callback, $call = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $path) {
            $callback();

            if ($call !== null) {
                $call();
            }
            exit();
        }
    }

    public static function post($path, $callback, $callback2 = null): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $path) {
            $callback();

            if ($callback2 !== null) {
                $callback2();
            }
            exit();
        }
    }

    public static function notFound(): void
    {
        http_response_code(404);
        require 'view/pages/404.php';
        exit();
    }
}