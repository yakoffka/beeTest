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

if ($controller_name === 'TaskController') {

    $result = '';
    if ($action_name === 'create') {

        $result = TaskController::create(
            $_POST['user_name'] ?? '',
            $_POST['email'] ?? '',
            $_POST['name'] ?? '',
            $_POST['description'] ?? ''
        );
        $redirect = '<meta http-equiv="refresh" content="0; url=/">';
    } elseif ($action_name === 'setSort') {
        $result = TaskController::setSort(
            $_POST['sort'] ?? 'id'
        );
        $redirect = '<meta http-equiv="refresh" content="0; url=/">';
    }

    [$include, $tasks, $currPage] = TaskController::index();
} elseif ($controller_name === 'UserController') {
    [$include, $vars] = UserController::$action_name();
} elseif ($controller_name === 'MigrationController') {
    [$include, $tasks] = MigrationController::$action_name();
} else {
    $include = ErrorController::show();
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php
    if (!empty($redirect)) {
        echo $redirect;
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <strong><?= APP_NAME ?></strong>
        </a>
    </div>
</div>


<div class="">

    <div class="content">
        <div class="container">

            <?php
                if (!empty($include)) {
                    include __DIR__ . '/app/views/' . $include . '.php';
                }
            ?>

            <div class="links">
                <a href="/task/index">task/index</a>
                <a href="/">migration/refresh</a><!-- /migration/refresh -->
                <a href="https://github.com/yakoffka/beeTest" target="_blank">GitHub</a>
            </div>

        </div>
    </div>
</div>
</body>
</html>