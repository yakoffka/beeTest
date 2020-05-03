<?php
$id = 'taskModalCenter' . $task->id;
?>

<!-- Button trigger modal -->
<a class="cursor_pointer" data-toggle="modal" data-target="#<?= $id ?>">
    <?= $task->description ?>
</a>

<!-- Modal -->
<div class="modal fade" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>Title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?= $task->name ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $task->description ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel_b" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>
