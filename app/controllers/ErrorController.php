<?php


namespace App\controllers;


class ErrorController
{
    public function index(): array
    {
        return ['view' => 'errors/404'];
    }
}