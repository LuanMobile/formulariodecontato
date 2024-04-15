<?php

namespace App\Http;

class Route
{
    private static array $routes = [];

    public static function get(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET',
        ];
    }

    public static function post(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'POST',
        ];
    }

    public static function routes()
    {
        return self::$routes;
    }
}
