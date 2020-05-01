<?php


namespace App\routes;


class Route
{
    static function start()
    {
        $model_name = 'Task';
        $action_name = 'index';

        $uriWithoutGetRequest = explode('?', $_SERVER['REQUEST_URI'])[0];
        $routes = explode('/', $uriWithoutGetRequest);

        if (!empty($routes[1])) {
            $model_name = ucfirst($routes[1]);
        }

        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $controller_name = $model_name . 'Controller';

        return [$controller_name, $action_name];
    }

}