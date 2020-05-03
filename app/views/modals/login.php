<?php
$id = 'loginModalCenter';
$modal ??= false;

if ( $modal && !empty($_SESSION['login_modal_show'])) {
    $m_class = ' show modal_login_yo"';
    //$m_style = ' style="padding-right: 12px; display: block;" aria-modal="true"';
    $m_style = ' style="display: block;" aria-modal="true"';
    $a_hidden = '';
    $b_close = '<a class="modal_close_yo" href="/">&times;</a>';
    $c_close = '<a class="modal_close_yo" href="/">cancel</a>';
    unset($_SESSION['login_modal_show']);
} else {
    $m_class = '"';
    $m_style = '';
    $a_hidden = ' aria-hidden="true"';
    $b_close = '&times;';
    $c_close = 'cancel';
}
?>

    <!-- Button trigger modal -->
    <a class="cursor_pointer" data-toggle="modal" data-target="#<?= $id ?>">
        login
    </a>


<?php
if ($modal) {
    ?>
    <!-- Modal -->
    <div class="modal fade<?= $m_class ?> id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>Title"
    <?= $a_hidden ?><?= $m_style ?>>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">login form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><?= $b_close ?></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="login_form" action="/user/authentication" method="post">
                    <input name="name" type="text" placeholder="enter your name" required>
                    <input name="password" type="password" placeholder="enter password" required>
                    <!--<input type="submit" value="go">-->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel_b" data-dismiss="modal"><?= $c_close ?></button>
                <input form="login_form" type="submit" class="btn btn-primary yo_submit" value="log in">
            </div>
        </div>
    </div>
    </div>

    <?php
}
