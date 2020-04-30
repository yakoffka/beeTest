<?php


namespace App\routes;

use App\controllers\TaskController;
use App\controllers\UserController;

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

//        $controller = new $controller_name();
//        if (method_exists($controller, $action_name)) {
//            return [$controller_name, $action_name];
//        }
//
//        return ['ErrorController', 'notFound'];

        return [$controller_name, $action_name];
    }

}