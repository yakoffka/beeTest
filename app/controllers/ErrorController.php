<?php


namespace App\controllers;


class ErrorController
{
    public static function show()
    {
        return ['view' => 'errors/404'];
    }
}