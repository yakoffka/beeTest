<?php


namespace App\controllers;


use App\models\Task;

class SeederController
{
    public static function seeding(): void
    {
        UserController::create('admin', 'admin@example.test', '123');
        Task::create(['user_name' => 'Фёдор', 'email' => 'feodor@example.test', 'name' => 'шифрование', 'description' => 'добавить шифрование пароля', 'done' => true]);
        Task::create(['user_name' => 'Якав', 'email' => 'ya@example.test', 'name' => 'валидация email', 'description' => 'продумать валидацию email', 'done' => true]);
        Task::create(['user_name' => 'Фёдор', 'email' => 'feodor@example.test', 'name' => 'DTO', 'description' => 'заменить массивы на DTO']);
        Task::create(['user_name' => 'Марина', 'email' => 'marina@example.test', 'name' => 'отредактировано администратором', 'description' => 'добавить отметку "отредактировано администратором"']);
        Task::create(['user_name' => 'Якав', 'email' => 'ya@example.test', 'name' => 'чистка данных', 'description' => 'проверить полученные от пользователя данные', 'done' => true]);
        Task::create(['user_name' => 'Дарья', 'email' => 'darya@example.test', 'name' => 'завершение задачи', 'description' => 'реализовать возможность отметить задачу как выполненную', 'done' => true]);
        Task::create(['user_name' => 'Виктор', 'email' => 'viktor@example.test', 'name' => 'завершение задачи', 'description' => 'вынести роутинг из index.php в отдельный файл']);
        Task::create(['user_name' => 'viktor', 'email' => 'vvd@example.test', 'name' => 'токен', 'description' => 'заменить ключ name в сессии на токен (проверка аутентификации)']);
        Task::create(['user_name' => 'viktor', 'email' => 'vvd@example.test', 'name' => 'ошибки валидации', 'description' => 'вывод ошибок валидации при попытке добавления задачи с незадолненными полями', 'done' => true]);
        Task::create(['user_name' => 'Яков', 'email' => 'ya@example.test', 'name' => 'правка уведомлений', 'description' => 'поправить вывод уведомлений (например о успешном сидировании юзера)']);
        Task::create(['user_name' => 'Настя', 'email' => 'nastya@example.test', 'name' => 'проверка XSS', 'description' => 'проверить приложение на отсутствие XSS уязвимости', 'done' => true]);
        Task::create(['user_name' => 'Марина', 'email' => 'marina@example.test', 'name' => 'сортировка по убыванию', 'description' => 'добавить сортировку по убыванию', 'done' => true]);
    }

}