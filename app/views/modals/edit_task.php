<?php
$task ??= null;
$id = 'editTaskModalCenter' . $task->id;
?>

<!-- Button trigger modal -->
<a class="cursor_pointer" data-toggle="modal" data-target="#<?= $id ?>">
    edit
</a>

<!-- Modal -->
<div class="modal fade" id="<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $id ?>Title"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">edit '<?= $task->name ?>' task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_task_form_<?= $task->id ?>" action="/task/update?id" method="post">

                    <input type="hidden" name="id" value="<?= $task->id ?>">
                    
                    <div class="row">
                        <div class="form-group col-9 pl0">
                            <label for="td_<?= $task->id ?>">task description</label>
                            <input value="<?= $task->description ?>" name="description" type="text" class="form-control"
                                   id="td_<?= $task->id ?>">
                        </div>

                        <div class="form-group col-3 pl0">
                            <label for="cb_<?= $task->id ?>">status</label><br>
                            <input name="done" type="checkbox" <?= $task->done ? 'checked' : '' ?> id="cb_<?= $task->id ?>">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn cancel_b" data-dismiss="modal">close</button>
                <input form="edit_task_form_<?= $task->id ?>" type="submit" class="btn btn-primary yo_submit"
                       value="edit task">
            </div>
        </div>
    </div>
</div>
