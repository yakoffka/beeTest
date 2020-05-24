<?php

namespace App\controllers;

use App\models\User;
use App\services\NotificationService;

class UserController extends BaseController
{
    protected array $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required',
    ];

    /**
     * User entry into the application
     */
    public function authentication(): void
    {
        $userData = $this->getValidated([
            'name',
            'password',
        ]);

        $user = $this->getUserByName($userData['name']);

        if (password_verify($userData['password'], $user->password)) {
            NotificationService::sendInfo('Hello! You are logged in as ' . $user->name);
            $_SESSION['name'] = $user->name;
            $this->redirect(APP_URL);
        }

        NotificationService::sendError('failed authentication!');
        $_SESSION['login_modal_show'] = ' show';
        $this->redirect(APP_URL);
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
     * @param $name
     * @return User
     */
    protected function getUserByName($name): User
    {
        $user = User::query()->whereName($name)->first();
        if ($user) {
            return $user;
        }

        NotificationService::sendError('failed authentication!');
        $_SESSION['login_modal_show'] = ' show';
        $this->redirect(APP_URL);
    }
}