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

        if (User::query()->firstWhere('email', '=', $email)) {
            $_SESSION['reportSuccess'][] = 'User already seeded!';
            header('Location: ' . APP_URL);
            die();
        }

        $user = User::create($userData);
        if ($user) {
            $_SESSION['reportSuccess'][] = 'User ' . $user->name . ' successfully seeded!';
        } else {
            $_SESSION['reportErrors'][] = 'Failed to seeded user.';
        }
        header('Location: ' . APP_URL);
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