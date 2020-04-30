<?php

namespace App\controllers;

use App\models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class TaskController
{
    /**
     * @return array
     */
    public static function index(): array
    {
        return [
            'view' => 'tasks/index',
            'tasks' => self::getTasks(),
            'currPage' => self::getCurrentPage(),
        ];
    }

    /**
     * @return void
     */
    public static function create(): void
    {
        $task = Task::create(self::getValidatedData());

        if ($task) {
            $_SESSION['reportSuccess'][] = 'Task ' . $task->name . ' successfully added!';
        } else {
            $_SESSION['reportErrors'][] = 'Failed to add task.';
        }
        // @todo: СДЕЛАТЬ РЕДИРЕКТ НА ПОСЛЕДНЮЮ СТРАНИЦУ!
        header('Location: ' . APP_URL);
    }

    /**
     * @return void
     */
    public static function edit(): void
    {
        $task = Task::create(self::getUpdateDataFromRequest());

        if ($task) {
            $_SESSION['reportSuccess'][] = 'Task ' . $task->name . ' successfully edited!';
        } else {
            $_SESSION['reportErrors'][] = 'Failed to edited task.';
        }
        // @todo: СДЕЛАТЬ РЕДИРЕКТ НА ТЕКУЩУЮ СТРАНИЦУ!
        header('Location: ' . APP_URL);
    }

    /**
     * @param $nameField
     */
    public static function setSort($nameField): void
    {
        $_SESSION['sortName'] = $nameField;
        header('Location: ' . APP_URL);
    }

    /**
     * @return int
     */
    private static function getCurrentPage(): int
    {
        return !empty($_GET['page']) ? (int)$_GET['page'] : 1;
    }

    /**
     * @return string
     */
    private static function getSortField(): string
    {
        return !empty($_SESSION['sortName']) ? $_SESSION['sortName'] : 'id';
    }

    /**
     * @return array
     */
    private static function getValidatedData(): array
    {
        $taskData = self::getCreateDataFromRequest();

        $reportErrors = [];
        foreach ($taskData as $nameField => $value) {
            if ($value === '') {
                $reportErrors[] = 'Поле должно ' . $nameField . ' быть заполнено';
            }
        }

        if (!empty($reportErrors)) {
            $_SESSION['reportErrors'] = $reportErrors;
            header('Location: ' . APP_URL);
            die();
        }
        return $taskData;
    }

    /**
     * @return Builder[]|Collection
     */
    private static function getTasks()
    {
        $sortField = self::getSortField();
        return Task::query()
            ->where('id', '>', 0)
            ->get()
            ->sortBy($sortField)
            ->chunk(Task::$chunk);
    }

    /**
     * @return array
     */
    private static function getCreateDataFromRequest(): array
    {
        // @todo: добавить безопасности.. все еще мало золота..
        return [
            'user_name' => $_POST['user_name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];
    }

    /**
     * @return array
     */
    private static function getUpdateDataFromRequest(): array
    {
        // @todo: добавить безопасности.. все еще мало золота..
        return [
            'done' => $_POST['done'] ? true : false,
            'description' => $_POST['description'] ?? ''
        ];
    }
}