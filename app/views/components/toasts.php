<!--<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">-->
<!-- Position it -->
<div style="position: absolute; top: 4em; right: 4em;">

    <?php
    foreach ($reportErrors as $key => $reportError) {
        $n = $key + 1;
        require __DIR__ . '/toasts.php';
    }
    ?>

    <!--<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header">
            <img src="..." class="rounded mr-2" alt="...">
            <strong class="mr-auto">Bootstrap</strong>
            <small class="text-muted">2 seconds ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Heads up, toasts will stack automatically
        </div>
    </div>-->
</div>
<!--</div>-->
