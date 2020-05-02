<?php


namespace App\services;


class NotificationService
{
    public static function sendError($message): void
    {
        $_SESSION['errors'][] = $message;
    }

    public static function sendWarning($message): void
    {
        $_SESSION['warning'][] = $message;
    }

    public static function sendInfo($message): void
    {
        $_SESSION['info'][] = $message;
    }
}