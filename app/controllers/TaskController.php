<?php

namespace App\controllers;

use App\models\Task;

class TaskController
{
    public static function index()
    {
        $tasks = Task::all();
        return ['tasks/index', $tasks];
    }

    public static function create(string $user_name, string $email, string $name, string $description)
    {
        Task::create([
            'user_name' => $user_name,
            'email' => $email,
            'name' => $name,
            'description' => $description,
        ]);
    }


}