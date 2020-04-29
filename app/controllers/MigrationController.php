<?php


namespace App\controllers;


use App\databases\migrations\TasksMigration;
use App\databases\migrations\UserMigration;

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

        return ['tasks/index', ['one', 'two']];
    }

}