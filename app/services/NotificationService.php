<?php


namespace App\services;


use App\models\Task;

class NotificationService
{
    public static function sendError($message): void
    {
        $_SESSION['errors'][] = $message;
        SlackService::sendSimpleMessage($message);
    }

    public static function sendWarning($message): void
    {
        $_SESSION['warning'][] = $message;
        SlackService::sendSimpleMessage($message);
    }

    public static function sendInfo($message): void
    {
        $_SESSION['info'][] = $message;
        SlackService::sendSimpleMessage($message);
    }

    public static function sendNewTaskNotify(Task $task): void
    {
        self::sendInfo('Task ' . $task->name . ' successfully edited!');
        SlackService::sendNewTaskMessage($task);
    }
}