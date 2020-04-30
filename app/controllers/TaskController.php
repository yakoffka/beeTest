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
     * @param string|null $userName
     * @param string|null $email
     * @param string|null $name
     * @param string|null $description
     * @return array|null
     */
    public static function create(string $userName = null, string $email = null, string $name = null, string $description = null): ?array
    {
        // @todo: заменить ($userName, $email, $name, $description) на request?
        $reportErrors = self::getValidateErrors($userName, $email, $name, $description);
        if (!empty($reportErrors)) {
            return [
                'view' => 'tasks/index',
                'tasks' => self::getTasks(),
                'currPage' => self::getCurrentPage(),
                'reportErrors' => $reportErrors
            ];
        }

        Task::create([
            'user_name' => $userName,
            'email' => $email,
            'name' => $name,
            'description' => $description,
        ]);
        // @todo: redirect!
    }

    /**
     * @param $nameField
     */
    public static function setSort($nameField): void
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

    /**
     * @return string
     */
    private static function getSortField(): string
    {
        return !empty($_SESSION['sortName']) ? $_SESSION['sortName'] : 'id';
    }

    /**
     * @param string $userName
     * @param string $email
     * @param string $name
     * @param string $description
     * @return array
     */
    private static function getValidateErrors(string $userName, string $email, string $name, string $description): array
    {
        $reportErrors = [];
        if ($userName === '') {
            $reportErrors[] = 'Поле должно userName быть заполнено';
        }
        if ($email === '') {
            $reportErrors[] = 'Поле должно email быть заполнено';
        }
        if ($name === '') {
            $reportErrors[] = 'Поле должно name быть заполнено';
        }
        if ($description === '') {
            $reportErrors[] = 'Поле должно description быть заполнено';
        }
        return $reportErrors;
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
}