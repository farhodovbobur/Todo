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
        return array_search('ap', $path);
    }

    public function getResourceId(): float|false|int|string
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = explode('/', $uri);
        return end($path);
    }

    public function isTelegramUpdate()
    {
        if (isset($this->updates) && isset($this->updates->update_id)) {
            return true;
        }
        return false;
    }
}