
<div style="position: absolute; top: 4em; right: 4em;">
    <?php
    if (!empty($_SESSION['reportErrors'])) {
        foreach ($_SESSION['reportErrors'] as $key => $reportError) {
            $n = $key + 1;
            $color = 'a60d10';
            $mess = $reportError;
            require __DIR__ . '/toast.php';
        }
        unset($_SESSION['reportErrors']);
    }

    if (!empty($_SESSION['reportSuccess'])) {
        foreach ($_SESSION['reportSuccess'] as $key => $reportError) {
            $n = $key + 5;
            $color = '00ccff';
            $mess = $reportError;
            require __DIR__ . '/toast.php';
        }
        unset($_SESSION['reportSuccess']);
    }
    ?>
</div>
