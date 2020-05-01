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
     * @return void|array
     */
    public static function edit(): ?array
    {
        $task = Task::find(self::getValidatedIDFromGet());
        if ($task) {
            return [
                'view' => 'tasks/show',
                'task' => $task,
            ];
        }
        // header('Location: ' . $_SERVER['HTTP_REFERER']);
        header('Location: ' . APP_URL);
    }

    /**
     * @return int
     */
    public static function getValidatedIDFromGet(): int
    {
        // @todo: добавить безопасности.. все еще мало золота..
        return (int)self::clean($_GET['id']);
    }

    /**
     * @return void
     */
    public static function update(): void
    {
        $task = Task::find(self::getValidatedIDFromPost());

        if ($task->update(self::getUpdateDataFromRequest())) {
            $_SESSION['reportSuccess'][] = 'Task ' . $task->name . ' successfully edited!';
        } else {
            $_SESSION['reportErrors'][] = 'Failed to edited task.';
        }
        // @todo: СДЕЛАТЬ РЕДИРЕКТ НА ТЕКУЩУЮ СТРАНИЦУ!
        header('Location: ' . APP_URL);
    }

    /**
     * @return int
     */
    public static function getValidatedIDFromPost(): int
    {
        // @todo: добавить безопасности.. все еще мало золота..
        return (int)self::clean($_POST['id']);
    }

    /**
     * @param $nameField
     */
    public static function setSort($nameField): void
    {
        // @todo: добавить безопасности.. все еще мало золота..
        $_SESSION['sortName'] = $nameField;
        $_SESSION['sortDesc'] = ($_SESSION['sortDesc'] === '1') ? '0' : '1';
        header('Location: ' . APP_URL);
    }

    /**
     * @return array
     */
    private static function getSortField(): array
    {
        $sortField = !empty($_SESSION['sortName']) ? $_SESSION['sortName'] : 'id';
        $descending = $_SESSION['sortDesc'] ?? '0';
        return [$sortField, $descending];
    }

    /**
     * @return int
     */
    private static function getCurrentPage(): int
    {
        return !empty($_GET['page']) ? (int)$_GET['page'] : 1;
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
        [$sortField, $descending] = self::getSortField();
        return Task::query()
            ->where('id', '>', 0)
            ->get()
            ->sortBy($sortField, SORT_REGULAR, $descending)
            ->chunk(Task::$chunk);
    }

    /**
     * @return array
     */
    private static function getCreateDataFromRequest(): array
    {
        return [
            'user_name' => self::clean($_POST['user_name']) ?? '',
            'email' => self::clean($_POST['email']) ?? '',
            'name' => self::clean($_POST['name']) ?? '',
            'description' => self::clean($_POST['description']) ?? ''
        ];
    }

    /**
     * @return array
     */
    private static function getUpdateDataFromRequest(): array
    {
        // @todo: добавить безопасности.. все еще мало золота..
        $return = [
            'done' => self::clean($_POST['done']) ? true : false,
        ];

        return $return;
    }

    /**
     * @param string $input
     * @return string
     */
    private static function clean(string $input)
    {
        return trim(htmlspecialchars(strip_tags($input)));
    }
}