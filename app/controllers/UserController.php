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
        $userData = self::getUserData($name, $email, $password);
        $user = User::create($userData);
        $_SESSION['reportSuccess'][] = 'User ' . $user->name . ' successfully seeded!';
        header('Location: ' . APP_URL);
    }

    /**
     * @return array|string[]
     */
    public static function index(): array
    {
        return ['users/index', ''];
    }

    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @return string[]
     */
    private static function getUserData(string $name, string $email, string $password): array
    {
        return [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];
    }
}