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
     * @return array|null
     */
    public static function create(): ?array
    {
        $taskData = self::getValidatedTaskData();
        $task = Task::create($taskData);

        if ($task) {
            $_SESSION['reportSuccess'][] = 'Task ' . $task->name . ' successfully added!';
        } else {
            $_SESSION['reportErrors'][] = 'Failed to add task.';
        }
        // @todo: СДЕЛАТЬ РЕДИРЕКТ НА ПОСЛЕДНЮЮ СТРАНИЦУ!
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
    private static function getValidatedTaskData(): array
    {
        $taskData = self::getTaskDataFromRequest();

        $reportErrors = [];
        foreach ($taskData as $nameField => $value) {
            if ($value === '') {$reportErrors[] = 'Поле должно ' . $nameField . ' быть заполнено';}
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
    private static function getTaskDataFromRequest(): array
    {
        // @todo: добавить безопасности.. все еще мало золота..
        return [
            'user_name' => $_POST['user_name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? ''
        ];
    }
}