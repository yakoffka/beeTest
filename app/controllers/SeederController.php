<?php


namespace App\controllers;


class SeederController
{
    public static function seedUser(): void
    {
        UserController::create('admin', 'admin@example.test', '123');
    }

}