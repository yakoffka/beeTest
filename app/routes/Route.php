<?php


namespace App\routes;


use App\controllers\ErrorController;
use App\controllers\TaskController;

class Route
{
    /**
     * @return mixed
     */
    public static function start(): ?array
    {
        $URI = explode('/', self::getClearURI());

        if (self::isEmptyURI($URI)) {
            $controller = new TaskController();
            return $controller->index();
        }

        $controller_name = 'App\controllers\\' . ucfirst($URI[1] ?? '') . 'Controller';

        if (class_exists($controller_name)) {
            $controller = new $controller_name;
            if (is_callable([$controller, $URI[2] ?? ''], false, $callable_name)) {
                return $controller->{$URI[2]}();
            }
        }

        $controller = new ErrorController();
        return $controller->index();
    }

    /**
     * @return mixed|string
     */
    protected static function getClearURI()
    {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
    }

    /**
     * @param array $uri
     * @return bool
     */
    protected static function isEmptyURI(array $uri): bool
    {
        foreach ($uri as $key => $val) {
            if (!empty($val)) {
                $isNoEmpty = true;
            }
        }

        return !($isNoEmpty ?? false);
    }
}