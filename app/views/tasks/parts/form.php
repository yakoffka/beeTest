<h2>Add task</h2>
<?php
if (DEBUG_MODE) {

    function randomString($len = 10)
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $lenLetters = strlen($letters);
        $result = '';

        for ($i = 0; $i < $len; $i++) {
            $result .= $letters[rand(0, $lenLetters - 1)];
        }
        return $result;
    }

    $user_name = 'value="' . ucfirst(randomString(rand(5, 8))) . '"';
    $user_email = 'value="' . randomString(rand(5, 8)) . '@example.ru"';
    $name = 'value="' . randomString(rand(5, 9)) . '"';

    for ($i = 0, $iMax = rand(5, 15); $i < $iMax; $i++) {
        $description = ($description ?? '') . randomString(rand(5, 8)) . ' ';
    }
    $description = 'value="' . $description . '"';
    $required = '';
}

$user_name ??= '';
$user_email ??= '';
$name ??= '';
$description ??= '';
$required ??= ' required';

?>
<form class="add_task" action="/task/store" method="post">
    <div class="row">

        <div class="form-group col-2 pl0">
            <label class="ellipsis" for="formGroupExampleInput">name</label>
            <input <?= $user_name ?> name="user_name" type="text" class="form-control" id="formGroupExampleInput"
                                     placeholder="enter your name"<?= $required ?>>
        </div>

        <div class="form-group col-2 pl0">
            <label class="ellipsis" for="formGroupExampleInput">email</label>
            <input <?= $user_email ?> name="email" pattern=".+@.+\..+" type="email" class="form-control"
                                      id="formGroupExampleInput" placeholder="enter your email"<?= $required ?>>
        </div>

        <div class="form-group col-2 pl0">
            <label class="ellipsis" for="formGroupExampleInput">task name</label>
            <input <?= $name ?> name="name" type="text" class="form-control" id="formGroupExampleInput"
                                placeholder="enter task name"<?= $required ?>>
        </div>

        <div class="form-group col-5 pl0">
            <label class="ellipsis" for="formGroupExampleInput">task description</label>
            <input <?= $description ?> name="description" type="text" class="form-control" id="formGroupExampleInput"
                                       placeholder="enter task description"<?= $required ?>>
        </div>

        <div class="form-group col-1 pl0">
            <label class="ellipsis" for="formGroupExampleInput">&nbsp;</label>
            <input type="submit" value="add">
        </div>

    </div>
</form>


