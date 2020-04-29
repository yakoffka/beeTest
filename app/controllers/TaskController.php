<?php

namespace App\controllers;

use App\models\Task;

class TaskController
{
    public static function index()
    {
        $currPage = self::getCurrentPage();
        $tasks = Task::query()
            ->where('id', '>', 0)
            ->get()
            // ->pluck('name')
            ->chunk(Task::$chunk);

        return ['tasks/index', $tasks, $currPage];
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

    /**
     * @return int
     */
    private static function getCurrentPage(): int
    {
        return $_GET['page'] ? (int)$_GET['page'] : 1;
    }


}