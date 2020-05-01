<div class="toasts">
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
            $n = $key + 1;
            $color = '00ccff';
            $mess = $reportError;
            require __DIR__ . '/toast.php';
        }
        unset($_SESSION['reportSuccess']);
    }
    ?>
</div>
