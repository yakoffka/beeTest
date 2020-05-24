<?php

$vars ??= null;
$tooltip = 'data-toggle="tooltip" data-trigger="click" data-placement="top"';

?>
<tr>
    <td class="ellipsis tr-tooltip" <?= $tooltip ?> title="<?= $task->user_name ?>">
        <?= $task->user_name ?>
    </td>

    <td class="ellipsis tr-tooltip" <?= $tooltip ?> title="<?= $task->email ?>">
        <?= $task->email ?>
    </td>

    <td class="ellipsis tr-tooltip">
        <?php
        include __DIR__ . '/../../modals/task.php';
        ?>
    </td>

    <td class="tac ellipsis">
        <?= $task->done ? '<span class="" title="completed">c</span>' : '' ?>
        <?= $task->edited ? '<span class="" title="edited">e</span>' : '' ?>
    </td>

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
