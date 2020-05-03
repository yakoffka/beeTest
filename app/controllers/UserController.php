<?php

namespace App\controllers;

use App\models\User;
use App\services\NotificationService;

class UserController extends BaseController
{
    /**
     * Show login form
     *
     * @return array|string[]
     */
    public function login(): array
    {
        return ['view' => 'users/login',];
    }

    /**
     * User entry into the application
     */
    public function authentication(): void
    {
        $userData = $this->getValidatedData();
        $user = User::query()->whereName($userData['name'])->first();

        if (password_verify($userData['password'], $user->password)) {
            NotificationService::sendInfo('Hello! You are logged in as ' . $user->name);
            $_SESSION['name'] = $user->name;
            $this->redirect(APP_URL);
        }

        NotificationService::sendError('failed authentication!');
        $this->redirect(LOGIN_URL);
    }

    /**
     * Logging out a user
     */
    public function logout(): void
    {
        unset($_SESSION['name']);
        NotificationService::sendInfo('see you..');
        $this->redirect(APP_URL);
    }

    /**
     * @return array
     */
    private function getValidatedData(): array
    {
        $userData = $this->getDataFromRequest();

        foreach ($userData as $nameField => $value) {
            if ($value === '') {
                $error = true;
                NotificationService::sendError($nameField . ' field must be filled');
            }
        }

        if (!empty($error)) {
            $this->redirect(LOGIN_URL);
        }

        return $userData;
    }

    /**
     * @return array
     */
    private function getDataFromRequest(): array
    {
        return [
            'name' => $this->clean($_POST['name'] ?? ''),
            'password' => $this->clean($_POST['password'] ?? ''),
        ];
    }

}