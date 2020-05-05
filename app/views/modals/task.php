<?php
$id = 'taskModalCenter' . $task->id;
?>

<!-- Button trigger modal -->
<a class="cursor_pointer" data-toggle="modal" data-target="#<?= $id ?>">
    <?= $task->description ?>
</a>

<!-- Modal -->
<div class="modal show_task fade" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>Title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                    <?= $task->done ? '<span class="mark completed">completed</span>' : '' ?>
                    <?= $task->edited ? '<span class="mark edited">edited</span>' : '' ?>
                    task '<?= $task->name ?>'
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= $task->description ?>
                <?= $task->edited ? '<!--div class="gray">[edited: ' . $task->updated_at . ']</div-->' : '' ?>
            </div>
            <div class="modal-footer">
                    <span class="gray created_at">
                        [task created: <?= $task->created_at ?>]
                    </span>
                <button type="button" class="btn cancel_b" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>
