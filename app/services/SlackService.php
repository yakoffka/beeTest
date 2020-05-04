<?php


namespace App\services;


use App\models\Task;

class SlackService
{
    private static string $commandStart = 'curl -X POST --data-urlencode "payload={\"channel\": \"#tasklist\", \"username\": \"webhookbot\", \"text\": \"';
    private static string $commandEnd = '\"}" ' . SLACK_WEBHOOK_URL;

    public static function sendNewTaskMessage(Task $task)
    {
        $message = 'Поставлена новая задача ' . $task->name . '. Описание: "' . $task->description . '".';
        static::sendSimpleMessage($message);
    }

    public static function sendSimpleMessage(string $message)
    {
        exec(static::$commandStart . $message . static::$commandEnd);
    }

}