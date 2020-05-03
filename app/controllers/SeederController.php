<?php


namespace App\controllers;


use App\models\Task;
use App\models\User;
use App\services\NotificationService;

class SeederController extends BaseController
{
    public function seedingAll(): void
    {
        $this->userSeeding();
        $this->tasksSeeding();
        $this->redirect(APP_URL);
    }

    public function seedingOnlyUser(): void
    {
        $this->userSeeding();
        $this->redirect(APP_URL);
    }

    protected function userSeeding(): void
    {
        $name = 'admin';
        $email = 'admin@example.test';
        $password = password_hash('123', PASSWORD_BCRYPT, ['cost' => 10,]);

        if ($this->getUser($email)) {
            NotificationService::sendWarning('User already seeded!');
            $this->redirect(APP_URL);
        }

        $user = User::create(['name' => $name, 'email' => $email, 'password' => $password]);
        if ($user) {
            NotificationService::sendInfo('User ' . $user->name . ' successfully seeded!');
        } else {
            NotificationService::sendError('User already seeded!');
        }
    }

    protected function tasksSeeding(): void
    {
        Task::create(['user_name' => 'Фёдор', 'email' => 'feodor@example.test', 'name' => 'шифрование', 'description' => 'добавить шифрование пароля', 'done' => true]);
        Task::create(['user_name' => 'Якав', 'email' => 'ya@example.test', 'name' => 'валидация email', 'description' => 'продумать валидацию email', 'done' => true]);
        Task::create(['user_name' => 'Фёдор', 'email' => 'feodor@example.test', 'name' => 'пункт 10', 'description' => 'смотри пункт 10 ТЗ', 'done' => true]);
        Task::create(['user_name' => 'Марина', 'email' => 'marina@example.test', 'name' => 'отредактировано администратором', 'description' => 'добавить отметку "отредактировано администратором"', 'done' => true]);
        Task::create(['user_name' => 'Якав', 'email' => 'ya@example.test', 'name' => 'чистка данных', 'description' => 'проверить полученные от пользователя данные', 'done' => true]);
        Task::create(['user_name' => 'Дарья', 'email' => 'darya@example.test', 'name' => 'завершение задачи', 'description' => 'реализовать возможность отметить задачу как выполненную', 'done' => true]);
        Task::create(['user_name' => 'viktor', 'email' => 'vvd@example.test', 'name' => 'ошибки валидации', 'description' => 'вывод ошибок валидации при попытке добавления задачи с незаполненными полями', 'done' => true]);
        Task::create(['user_name' => 'Яков', 'email' => 'ya@example.test', 'name' => 'правка уведомлений', 'description' => 'сломался вывод уведомлений (например о успешном сидировании юзера) - поправить', 'done' => true]);
        Task::create(['user_name' => 'Настя', 'email' => 'nastya@example.test', 'name' => 'проверка XSS', 'description' => 'проверить приложение на отсутствие XSS уязвимости', 'done' => true]);
        Task::create(['user_name' => 'Марина', 'email' => 'marina@example.test', 'name' => 'сортировка по убыванию', 'description' => 'добавить сортировку по убыванию', 'done' => true]);

        NotificationService::sendInfo('Tasks successfully seeded!');
    }

    /**
     * @param string $email
     * @return User|null
     */
    protected function getUser(string $email): ?User
    {
        return User::query()->firstWhere('email', '=', $email);
    }
}