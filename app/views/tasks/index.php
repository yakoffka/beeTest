<?php

// @todo: what???
if (!empty($result)) {
    echo '<h2>task added</h2>';
}

$tasks = $vars['tasks'];

include __DIR__ . '/parts/list.php';
include __DIR__ . '/parts/form.php';

