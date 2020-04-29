<?php

if (!empty($result)) {
    echo '<h2>task added</h2>';
}


if (count($tasks) > 0) {

    require __DIR__ . '/pagination.php';

    echo '
    <h2>task list</h2>
    <table class="table">
        <tr>
            <th scope="col" style="width: 5%">id <form action="/task/setSort" method="post"><input type="hidden" name="sort" value="id"><input type="submit" value="sort"></form></th>
            <th scope="col" style="width: 20%">name <form action="/task/setSort" method="post"><input type="hidden" name="sort" value="name"><input type="submit" value="sort"></form></th>
            <th scope="col" style="width: 51%">description <form action="/task/setSort" method="post"><input type="hidden" name="sort" value="description"><input type="submit" value="sort"></form></th>
            <th scope="col" style="width: 12%">user name <form action="/task/setSort" method="post"><input type="hidden" name="sort" value="user_name"><input type="submit" value="sort"></form></th>
            <th scope="col" style="width: 12%">user email <form action="/task/setSort" method="post"><input type="hidden" name="sort" value="email"><input type="submit" value="sort"></form></th>
        </tr>';

    foreach ($tasks[($currPage-1)] as $task) {
        require __DIR__ . '/task_row.php';
    }
    echo '
    </table>
    ';
}
?>

<h2>add task</h2>
<form action="/task/create" method="post">
    <input name="name" type="text" placeholder="enter task name">
    <input name="description" type="text" placeholder="enter task description">
    <input name="user_name" type="text" placeholder="enter your name">
    <input name="email" type="text" placeholder="enter your email">
    <input type="submit" value="submit">
</form>
