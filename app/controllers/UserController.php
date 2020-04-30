<?php

namespace App\controllers;

use App\models\User;

class UserController
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public static function create(string $name, string $email, string $password): void
    {
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    /**
     * @return array|string[]
     */
    public static function index(): array
    {
        return ['users/index', ''];
    }
}