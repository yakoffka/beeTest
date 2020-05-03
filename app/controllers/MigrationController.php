<?php


namespace App\controllers;


use App\databases\migrations\TasksMigration;
use App\databases\migrations\UserMigration;
use App\services\NotificationService;

class MigrationController extends BaseController
{
    /**
     * @return void
     */
    public function refresh(): void
    {
        $this->migrate();
        $this->redirect(APP_URL);
    }

    /**
     * performs migration
     */
    private function migrate(): void
    {
        $this->taskMigrate();
        $this->userMigrate();
    }

    /**
     * performs task table migration
     */
    private function taskMigrate(): void
    {
        $taskMigration = new TasksMigration();
        $taskMigration->down();
        $taskMigration->up();
        NotificationService::sendInfo('"tasks" table refresh successfully');
    }

    /**
     * performs user table migration
     */
    private function userMigrate(): void
    {
        $userMigration = new UserMigration();
        $userMigration->down();
        $userMigration->up();
        NotificationService::sendInfo('"users" table refresh successfully');
    }
}