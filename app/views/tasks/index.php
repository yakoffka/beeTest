<?php
if (!isset($vars)) {
    $vars = [];
}

$tasks = $vars['tasks'];
include __DIR__ . '/parts/list.php';
include __DIR__ . '/parts/form.php';

