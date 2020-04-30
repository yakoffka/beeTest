<?php


namespace App\controllers;


use App\databases\migrations\TasksMigration;
use App\databases\migrations\UserMigration;
use App\models\Task;

class MigrationController
{
    public static function refresh()
    {
        self::migrate();
        $tasks = Task::all();
        return ['view' => 'tasks/index', 'tasks' => $tasks];
    }

    private static function migrate(): void
    {
        self::taskMigrate();
        self::userMigrate();
    }

    private static function taskMigrate(): void
    {
        $taskMigration = new TasksMigration();
        $taskMigration->down();
        $taskMigration->up();
    }

    private static function userMigrate(): void
    {
        $userMigration = new UserMigration();
        $userMigration->down();
        $userMigration->up();
    }
}