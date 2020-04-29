<?php

namespace App\controllers;

use App\models\User;

class UserController
{
    public static function create(string $name, string $email, string $password)
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    public static function index()
    {
        return ['users/index', ''];
    }
}