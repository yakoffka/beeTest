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
        // die();
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
            'password' => password_hash($password, PASSWORD_BCRYPT, ['cost' => 10,]),
        ];
    }

    /**
     * show login form
     * @return array|string[]
     */
    public static function login(): array
    {
        return ['view' => 'users/login',];
    }

    public static function authentication(): void
    {
        $userData = self::getValidatedData();
        $user = User::query()->whereName($userData['name'])->first();

        if (password_verify($userData['password'], $user->password)) {
            $_SESSION['reportSuccess'][] = 'Hello! You are logged in as ' . $user->name . '.';
            $_SESSION['name'] = $user->name;
            header('Location: ' . APP_URL);
            die();
        }

        $_SESSION['reportErrors'][] = 'failed authentication!';
        header('Location: ' . LOGIN_URL);
        die();
    }

    public static function logout(): void
    {
        unset($_SESSION['name']);
        $_SESSION['reportSuccess'][] = 'see you..';
        header('Location: ' . APP_URL);
        die();
    }

    /**
     * @return array
     */
    private static function getValidatedData(): array
    {
        $userData = self::getDataFromRequest();

        $reportErrors = [];
        foreach ($userData as $nameField => $value) {
            if ($value === '') {
                $reportErrors[] = $nameField . ' field must be filled';
            }
        }

        if (!empty($reportErrors)) {
            $_SESSION['reportErrors'] = $reportErrors;
            header('Location: ' . LOGIN_URL);
            die();
        }
        return $userData;
    }

    /**
     * @return array
     */
    private static function getDataFromRequest(): array
    {
        return [
            'name' => $_POST['name'],
            'password' => $_POST['password'],
        ];
    }

}