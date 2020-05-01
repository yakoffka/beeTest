<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use App\controllers\ErrorController;
use App\controllers\MigrationController;
use App\controllers\SeederController;
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
    $vars = TaskController::$action_name();

} elseif ($controller_name === 'UserController') {
    $vars = UserController::$action_name();

} elseif ($controller_name === 'MigrationController') {
    $vars = MigrationController::$action_name();

} elseif ($controller_name === 'SeederController') {
    $vars = SeederController::$action_name();

} else {
    $vars = ErrorController::show();
}

include __DIR__ . '/app/views/layouts/app.php';

