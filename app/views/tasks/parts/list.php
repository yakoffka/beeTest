<h2>Task list</h2>
<div class="row">
    <?php
    if (!isset($tasks)) {
        $tasks = null;
    }
    if (count($tasks) > 0) {
    require __DIR__ . '/pagination.php';
    ?>
    <table class="table">
        <tr>
            <th scope="col" class="sort_th" style="width: 12%">
                <form action="/task/setSort" class="sort_th" method="post">
                    <input type="hidden" name="sort" value="user_name">
                    <input type="hidden" name="desc"
                           value="<?= (!empty($_SESSION['sortName']) && $_SESSION['sortName'] === 'user_name') && (!empty($_SESSION['desc']) && $_SESSION['desc'] === 'asc') ? 'desc' : 'asc' ?>">
                    <input type="submit" value="пользователь">
                </form>
            </th>

            <th scope="col" class="sort_th" style="width: 12%">
                <form action="/task/setSort" class="sort_th" method="post">
                    <input type="hidden" name="sort" value="email">
                    <input type="hidden" name="desc"
                           value="<?= (!empty($_SESSION['sortName']) && $_SESSION['sortName'] === 'user_name') && (!empty($_SESSION['desc']) && $_SESSION['desc'] === 'asc') ? 'desc' : 'asc' ?>">
                    <input type="submit" value="email">
                </form>
            </th>

            <th scope="col" class="sort_th" style="width: <?= !empty($_SESSION['sortName']) ? '45' : '50' ?>%">
                <form action="/task/setSort" class="sort_th" method="post">
                    <input type="hidden" name="sort" value="description">
                    <input type="hidden" name="desc"
                           value="<?= (!empty($_SESSION['sortName']) && $_SESSION['sortName'] === 'user_name') && (!empty($_SESSION['desc']) && $_SESSION['desc'] === 'asc') ? 'desc' : 'asc' ?>">
                    <input type="submit" value="текст задачи">
                </form>
            </th>

            <th scope="col" class="sort_th" style="width: 5%">
                <form action="/task/setSort" class="sort_th" method="post">
                    <input type="hidden" name="sort" value="done">
                    <input type="hidden" name="desc"
                           value="<?= (!empty($_SESSION['sortName']) && $_SESSION['sortName'] === 'user_name') && (!empty($_SESSION['desc']) && $_SESSION['desc'] === 'asc') ? 'desc' : 'asc' ?>">
                    <input type="submit" value="статус">
                </form>
            </th>

            <?php
            if (!empty($_SESSION['name'])) {
                ?>
                <th scope="col" class="sort_th" style="width: 5%">
                    <form action="/task/setSort" class="sort_th" method="post">
                        <input type="hidden" name="sort" value="done">
                        <input type="hidden" name="desc"
                               value="<?= (!empty($_SESSION['sortName']) && $_SESSION['sortName'] === 'user_name') && (!empty($_SESSION['desc']) && $_SESSION['desc'] === 'asc') ? 'desc' : 'asc' ?>">
                        <input type="submit" value="действия">
                    </form>
                </th>
                <?php
            }
            ?>
        </tr>

        <?php
        if (!isset($vars)) {
            $vars = [];
        }
        foreach ($tasks[($vars['currPage'] - 1)] as $task) {
            require __DIR__ . '/task_row.php';
        }
        ?>
    </table>

<?php
} else {
    echo '<div class="empty_list">The list of tasks is still empty. But you can add the first task!</div>';
}
echo '</div>';