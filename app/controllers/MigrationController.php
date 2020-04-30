<?php


namespace App\controllers;


use App\databases\migrations\TasksMigration;
use App\databases\migrations\UserMigration;
use App\models\Task;

class MigrationController
{
    /**
     * @return array
     */
    public static function refresh(): array
    {
        self::migrate();
        $tasks = Task::all();
        return ['view' => 'tasks/index', 'tasks' => $tasks];
    }

    /**
     * performs migration
     */
    private static function migrate(): void
    {
        self::taskMigrate();
        self::userMigrate();
    }

    /**
     * performs task table migration
     */
    private static function taskMigrate(): void
    {
        $taskMigration = new TasksMigration();
        $taskMigration->down();
        $taskMigration->up();
    }

    /**
     * performs user table migration
     */
    private static function userMigrate(): void
    {
        $userMigration = new UserMigration();
        $userMigration->down();
        $userMigration->up();
    }
}