<?php


namespace App\controllers;


use App\databases\migrations\TasksMigration;
use App\databases\migrations\UserMigration;

class MigrationController
{
    /**
     * @return void
     */
    public static function refresh(): void
    {
        self::migrate();
        header('Location: ' . APP_URL);
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