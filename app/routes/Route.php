<?php


namespace App\routes;


class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $model_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $model_name = $routes[1];
        }

        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $controller_name = $model_name . 'Controller';

        if(method_exists($controller_name, $action_name))
        {
            return [$controller_name, $action_name];
        } else {
            return ['ErrorController', 'notFound'];
        }
    }

}