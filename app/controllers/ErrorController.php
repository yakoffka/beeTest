<?php


namespace App\controllers;


class ErrorController
{
    public static function show(): array
    {
        return ['view' => 'errors/404'];
    }
}