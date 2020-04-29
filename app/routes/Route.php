<?php


namespace App\routes;

use App\controllers\TaskController;
use App\controllers\UserController;

class Route
{
    static function start()
    {
        // контроллер и действие по умолчанию
        $model_name = 'Task';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $model_name = ucfirst($routes[1]);
        }

        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $controller_name = $model_name . 'Controller';

//        $controller = new $controller_name();
//        if (method_exists($controller, $action_name)) {
//            return [$controller_name, $action_name];
//        }
//
//        return ['ErrorController', 'notFound'];

        return [$controller_name, $action_name];
    }

}