<?php
if (!isset($task)) {
    $vars = null;
}
$tooltip = 'data-toggle="tooltip" data-trigger="click" data-placement="top"';
?>
<tr>
    <td class="ellipsis tr-tooltip" <?= $tooltip ?> title="<?= $task->user_name ?>"><?= $task->user_name ?></td>
    <td class="ellipsis tr-tooltip" <?= $tooltip ?> title="<?= $task->email ?>"><?= $task->email ?></td>
    <td class="ellipsis tr-tooltip" <?= $tooltip ?> title="<?= $task->description ?>"><?= $task->description ?></td>
    <td class="tac ellipsis"><?= $task->done ? 'done' : ' - ' ?></td>
    <?php
    if (!empty($_SESSION['name'])) {
        ?>
        <td scope="col" class="tac ellipsis">
            <a href="/task/edit?id=<?= $task->id ?>">edit</a>
            <!--<form action="/task/edit/<?/*= $task->id */ ?>" class="sort_form" method="post">
                        <input type="submit" value="edit">
                    </form>-->
        </td>
        <?php
    }
    ?>
</tr>
