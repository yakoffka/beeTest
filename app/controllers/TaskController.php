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
        header('Location: ' . APP_URL);
    }

    /**
     * show form
     * @return void|array
     */
    public static function edit(): ?array
    {
        self::authorizeUser();
        $task = Task::find(self::getValidatedIDFromGet());
        if ($task) {
            return [
                'view' => 'tasks/show',
                'task' => $task,
            ];
        }
        header('Location: ' . APP_URL);
    }

    /**
     * @return int
     */
    public static function getValidatedIDFromGet(): int
    {
        return self::clean((int)$_GET['id']);
    }

    /**
     * @return void
     */
    public static function update(): void
    {
        self::authorizeUser();
        $task = self::getTask();
        self::updateEdited($task);
        header('Location: ' . APP_URL);
    }

    /**
     * @return int
     */
    public static function getValidatedIDFromPost(): int
    {
        return self::clean((int)$_POST['id']);
    }

    /**
     * sorting task list
     */
    public static function setSort(): void
    {
        $nameField = self::clean($_POST['sort']) ?? 'id';
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
        return !empty($_GET['page']) ? self::clean((int)($_GET['page'])) : 1;
    }

    /**
     * @return array
     */
    private static function getValidatedData(): array
    {
        $taskData = self::getCleanCreateData();

        $reportErrors = [];
        foreach ($taskData as $nameField => $value) {
            if ($value === '') {
                $reportErrors[] = $nameField . ' field must be filled';
            }
            if (($nameField === 'email') && preg_match('~.+@.+\..+~', $value) !== 1) {
                $reportErrors[] = 'Field ' . $nameField . ' is not valid';
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
     * @return Collection
     */
    private static function getTasks(): Collection
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
    private static function getCleanCreateData(): array
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
    private static function getCleanUpdateData(): array
    {
        return [
            'description' => self::clean($_POST['description'] ?? ''),
            'done' => self::clean($_POST['done'] ?? '') ? '1' : '0',
        ];
    }

    /**
     * @param string $input
     * @return string
     */
    public static function clean(string $input): string
    {
        return trim(htmlspecialchars(strip_tags($input)));
    }

    /**
     * user authorization check
     */
    private static function authorizeUser(): void
    {
        if (empty($_SESSION['name'])) {
            header('Location: ' . LOGIN_URL);
            die();
        }
    }

    /**
     * @return Task|null
     */
    private static function getTask(): ?Task
    {
        $task = Task::find(self::getValidatedIDFromPost());
        if (!$task) {
            $_SESSION['reportErrors'][] = 'Failed to edited task.';
            header('Location: ' . APP_URL);
        }
        return $task;
    }

    /**
     * @param $task
     */
    private static function updateEdited($task): void
    {
        $dataFromRequest = self::getCleanUpdateData();
        $task->description = $dataFromRequest['description'];
        $task->done = $dataFromRequest['done'];
        if ($task->isDirty('description')) {
            $task->edited = true;
        }

        if ($task->save()) {
            $_SESSION['reportSuccess'][] = 'Task ' . $task->name . ' successfully edited!';
        } else {
            $_SESSION['reportErrors'][] = 'Failed to edited task.';
        }
    }
}