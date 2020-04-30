        <tr>
            <td><?=$task->user_name?></td>
            <td><?=$task->email?></td>
            <td><?=$task->description?></td>
            <td style="text-align: center"><?= $task->done ? 'done' : ' - '?></td>
            <?php
            if (!empty($_SESSION['name'])) {
                ?>
                <td scope="col" style="text-align: center">
                    <a href="/task/edit?id=<?= $task->id ?>">edit</a>
                    <!--<form action="/task/edit/<?/*= $task->id */?>" class="sort_form" method="post">
                        <input type="submit" value="edit">
                    </form>-->
                </td>
                <?php
            }
            ?>
        </tr>
