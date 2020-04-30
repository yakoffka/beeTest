<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//phpinfo();
//die();

use App\controllers\ErrorController;
use App\controllers\MigrationController;
use App\controllers\TaskController;
use App\controllers\UserController;
use App\databases\CapsuleInstance;
use App\routes\Route;

require 'config.php';
require 'vendor/autoload.php';

session_start();

$capsule = new CapsuleInstance();

[$controller_name, $action_name] = Route::start();

// @todo: вынести роутинг в отдельный файл
if ($controller_name === 'TaskController') {

    $result = '';
    if ($action_name === 'create') {

        $result = TaskController::create(
            $_POST['user_name'] ?? '',
            $_POST['email'] ?? '',
            $_POST['name'] ?? '',
            $_POST['description'] ?? ''
        );
        // @todo: заменить редирект на редирект с помощью заголовков?
        // $redirect = '<meta http-equiv="refresh" content="0; url=/">';

    } elseif ($action_name === 'setSort') {
        $result = TaskController::setSort(
            $_POST['sort'] ?? 'id'
        );
        $redirect = '<meta http-equiv="refresh" content="0; url=/">';
    }

    // [$include, $tasks, $vars['currPage']] = TaskController::index();
    $vars = TaskController::index();
} elseif ($controller_name === 'UserController') {
    [$include, $vars] = UserController::$action_name();
} elseif ($controller_name === 'MigrationController') {
    [$include, $tasks] = MigrationController::$action_name();
} else {
    $include = ErrorController::show();
}


// @todo: вынести html в какой-нибудь layout
include __DIR__ . '/app/views/layouts/app.php';

?>
