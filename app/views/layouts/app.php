<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/app/views/assets/style.css">
</head>
<body>


<div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <strong><?= APP_NAME ?> v<?= APP_VERSION ?></strong>
        </a>

        <div class="login">
            <?php
            if (!empty($_SESSION['name'])) {
                echo 'You are logged in as ' . $_SESSION['name'] . ' <a href="/user/logout">logout</a>';
            } else {
                include __DIR__ . '/../modals/login.php';
            }
            ?>
        </div>

    </div>
</div>


<div class="container">

    <?php
    include __DIR__ . '/../components/toasts.php';
    ?>

    <?php
    if (!empty($vars['view'])) {
        include __DIR__ . '/../' . $vars['view'] . '.php';
    }
    ?>

    <div class="links">

        <?php

        include __DIR__ . '/../modals/info.php';

        if (!empty($_SESSION['name'])) {
            echo '<a href="/user/logout">logout</a>';
        } else {
            $modal = true;
            include __DIR__ . '/../modals/login.php';
        }
        ?>

        <a href="/task/index">tasks</a>
        <?php
        if (!empty($_SESSION['name'])) {
            ?>
            <a href="/migration/refresh">migration refresh</a>
            <a href="/seeder/seedingTask">seeding tasks</a>
            <?php
        }
        ?>
        <a href="https://github.com/yakoffka/beeTest" target="_blank">GitHub</a>
    </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<!--Инициализация всплывающих сообщений через JavaScript-->
<script>
    $('.toast').toast('show');
</script>

<script>
    $('.tr-tooltip').tooltip({
        delay: {show: 50, hide: 50},
        boundary: 'string'
    })
</script>

<?php
session_write_close();
?>
</body>
</html>
