<div class="toasts">
    <?php

    if (!empty($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $key => $reportError) {
            $n = $key + 1;
            $color = 'a60d10';
            $mess = $reportError;
            require __DIR__ . '/toast.php';
        }
        unset($_SESSION['errors']);
    }

    if (!empty($_SESSION['warning'])) {
        foreach ($_SESSION['warning'] as $key => $reportError) {
            $n = $key + 1;
            $color = 'ff9900';
            $mess = $reportError;
            require __DIR__ . '/toast.php';
        }
        unset($_SESSION['warning'])    ;
    }

    if (!empty($_SESSION['info'])) {
        foreach ($_SESSION['info'] as $key => $reportError) {
            $n = $key + 1;
            $color = '00ccff';
            $mess = $reportError;
            require __DIR__ . '/toast.php';
        }
        unset($_SESSION['info'])    ;
    }

    ?>
</div>
