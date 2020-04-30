<h2>Task list</h2>
<div class="row">
    <?php
    if (count($tasks) > 0) {
    require __DIR__ . '/pagination.php';
    ?>
    <table class="table">
        <tr>
            <th scope="col" style="width: 12%">
                <form action="/task/setSort" class="sort_form" method="post">
                    <input type="hidden" name="sort" value="user_name">
                    <input type="submit" value="пользователь"></form>
            </th>

            <th scope="col" style="width: 12%">
                <form action="/task/setSort" class="sort_form" method="post">
                    <input type="hidden" name="sort" value="email">
                    <input type="submit" value="email">
                </form>
            </th>

            <th scope="col" style="width: 51%">
                <form action="/task/setSort" class="sort_form" method="post">
                    <input type="hidden" name="sort" value="description">
                    <input type="submit" value="текст задачи"></form>
            </th>

            <th scope="col" style="width: 5%">
                <form action="/task/setSort" class="sort_form" method="post">
                    <input type="hidden" name="sort" value="done">
                    <input type="submit" value="статус">
                </form>
            </th>
        </tr>

        <?php
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