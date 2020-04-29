<?php

namespace App\controllers;

use App\models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskController
{
    public static function index()
    {
        $currPage = self::getCurrentPage();
        $sortField = self::getSortField();
        $tasks = Task::query()
            ->where('id', '>', 0)
            ->get()
            ->sortBy($sortField)
            ->chunk(Task::$chunk);

        return ['tasks/index', $tasks, $currPage];
    }

    public static function create(string $userName, string $email, string $name, string $description)
    {
        Task::create([
            'user_name' => $userName,
            'email' => $email,
            'name' => $name,
            'description' => $description,
        ]);
    }

    public static function setSort($nameField)
    {
        $_SESSION['sortName'] = $nameField;
    }

    /**
     * @return int
     */
    private static function getCurrentPage(): int
    {
        return !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    }

    private static function getSortField(): string
    {
        return !empty($_SESSION['sortName']) ? $_SESSION['sortName'] : 'id';
    }
}