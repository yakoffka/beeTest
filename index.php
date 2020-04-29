<?php

use App\controllers\TaskController;
use App\controllers\UserController;
use App\databases\CapsuleInstance;
use App\routes\Route;

require 'config.php';
require 'vendor/autoload.php';

$capsule = new CapsuleInstance();

[$controller_name, $action_name] = Route::start();

if ($controller_name === 'TaskController') {
    TaskController::$action_name();
} elseif ($controller_name ===  'UserController') {
    UserController::$action_name();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            /*font-family: 'Nunito', sans-serif;*/
            font-weight: 200;
            /*height: 100vh;*/
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            /*text-transform: uppercase;*/
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="">

    <div class="content">
        <div class="title m-b-md">
            <?= APP_NAME ?>
        </div>

        <div class="links">
            <a href="/task/index" target="_blank">task/index</a>
            <a href="/user/index" target="_blank">user/index</a>
            <a href="https://github.com/yakoffka/beeTest" target="_blank">GitHub</a>
            <a href="https://github.com/yakoffka/beeTest" target="_blank">GitHub</a>
        </div>
    </div>
</div>
</body>
</html>