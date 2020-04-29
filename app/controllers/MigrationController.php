<?php


namespace App\controllers;


use App\databases\migrations\TasksMigration;
use App\databases\migrations\UserMigration;
use App\models\Task;

class MigrationController
{
    public static function refresh()
    {
        $taskMigration = new TasksMigration();
        $taskMigration->down();
        $taskMigration->up();

        $userMigration = new UserMigration();
        $userMigration->down();
        $userMigration->up();

        $tasks = Task::all();
        return ['tasks/index', $tasks];
    }

}