<?php

if (!empty($result)) {
    echo '<h2>task added</h2>';
}

if (count($tasks) > 0) {
    echo '
    <h2>task list</h2>
    <table class="table">
      <tr>
          <th scope="col">id</th>
          <th scope="col">name</th>
          <th scope="col">description</th>
          <th scope="col">user name</th>
          <th scope="col">user email</th>
        </tr>';

    foreach ($tasks as $task) {
        require __DIR__ . '/task_row.php';
    }
    echo '
    </table>
    ';
}
?>

<h2>add task</h2>
<form action="/task/create" method="post">
    <input name="user_name" type="text" placeholder="enter your name">
    <input name="email" type="text" placeholder="enter your email">
    <input name="name" type="text" placeholder="enter task name">
    <input name="description" type="text" placeholder="enter task description">
    <input type="submit" value="submit">
</form>
