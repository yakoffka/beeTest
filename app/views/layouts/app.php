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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="/app/views/assets/style.css">
</head>
<body>

<div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <a href="/" class="navbar-brand d-flex align-items-center">
            <strong><?= APP_NAME ?></strong>
        </a>

        <span class="info">
            <?php
            echo 'sorting: ' . ($_SESSION['sortName'] ?? 'none') . ';';
            ?>
        </span>

    </div>
</div>


<div class="">
    <div class="content">
        <div class="container">

            <?php
            if (!empty($reportErrors)) {
                include __DIR__ . '/../components/toasts.php';
            }
            ?>

            <?php
            if (!empty($vars['view'])) {
                include __DIR__ . '/../' . $vars['view'] . '.php';
            }
            ?>

            <div class="links">
                <a href="/task/index">tasks</a>
                <a href="/">migration refresh</a><!-- /migration/refresh -->
                <a href="https://github.com/yakoffka/beeTest" target="_blank">GitHub</a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<!--Инициализация всплывающих сообщений через JavaScript-->
<script>
    $('.toast').toast('show');
</script>

</body>
</html>