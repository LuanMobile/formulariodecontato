<?php

namespace App\Core;

class Core
{
    public static function dispatch(array $routes)
    {
        $url = '/';

        isset($_GET['url']) && $url .= $_GET['url'];
        // var_dump($_SERVER['REQUEST_URI'], $routes);
        $url !== '/' && $url = rtrim($url, '/');

        $prefixController = 'App\\Controllers\\';

        $routeFound = false;

        foreach ($routes as $route) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

            [$controller, $action] = explode('@', $route['action']);

            $controller = $prefixController . $controller;
            $extendController = new $controller();
            $extendController->$action();
            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routeFound = true;

                // if ($route['method'] !== Request::method()) {
                //     Response::json([
                //         'error'   => true,
                //         'success' => false,
                //         'message' => 'Sorry, method not allowed.'
                //     ], 405);
                //     return;
                // }


            }
        }

        // if (!$routeFound) {
        //     $controller = $prefixController . 'NotFoundController';
        //     $extendController = new $controller();
        //     $extendController->index(new Request, new Response);
        // }
    }
}
