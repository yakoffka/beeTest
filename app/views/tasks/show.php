<?php
if (!isset($vars)) {
    $vars = [];
}
$task = $vars['task'];
?>
<h2>Task #<?= $task->id ?> '<?= $task->name ?>'</h2>
<form action="/task/update?id" method="post">

    <input type="hidden" name="id" value="<?= $task->id ?>">
    <label>
        edit description
        <input name="description" type="text" style="width: 40%" value="<?= $task->description ?>">
    </label>
    <label>
        done
        <input name="done" type="checkbox" <?= $task->done ? 'checked' : '' ?>>
    </label>
    <input type="submit" value="submit">
</form>