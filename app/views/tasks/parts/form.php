<h2>Add task</h2>
<form action="/task/store" method="post">
    <input name="user_name" type="text" placeholder="enter your name"><!--required-->
    <input name="email" type="text" placeholder="enter your email"><!--required-->
    <input name="name" type="text" placeholder="enter task name"><!--required-->
    <input name="description" type="text" placeholder="enter task description"><!--required-->
    <input type="submit" value="submit">
</form>