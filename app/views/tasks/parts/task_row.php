<?php

$vars ??= null;
$tooltip = 'data-toggle="tooltip" data-trigger="click" data-placement="top"';

?>
<tr>
    <td class="ellipsis tr-tooltip" <?= $tooltip ?> title="<?= $task->user_name ?>"><?= $task->user_name ?></td>
    <td class="ellipsis tr-tooltip" <?= $tooltip ?> title="<?= $task->email ?>"><?= $task->email ?></td>
    <td class="ellipsis tr-tooltip">
        <span class="gray"><?= $task->edited ? '[edited]' : '' ?></span>

        <?php
        include __DIR__ . '/../../modals/task.php';
        ?>

    </td>
    <td class="tac ellipsis"><?= $task->done ? 'done' : ' - ' ?></td>
    <?php
    if (!empty($_SESSION['name'])) {
        ?>
        <td scope="col" class="tac ellipsis">
            <!--<a href="/task/edit?id=<?= $task->id ?>">edit</a>-->

            <?php
            include __DIR__ . '/../../modals/edit_task.php';
            ?>

        </td>
        <?php
    }
    ?>
</tr>
