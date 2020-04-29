<?php

use App\databases\CapsuleInstance;
use App\databases\migrations\TasksMigration;
use Illuminate\Database\Capsule\Manager as Capsule;

require 'config.php';
require 'vendor/autoload.php';

// phpinfo();

echo 'hello, i am fine...' . "\n<br>";

$db = new CapsuleInstance();
var_dump($db);


$migration = new TasksMigration();
var_dump($migration);


$migration->up();
die();
//
//
//if (Capsule::table('task')->exists()) {
//    echo 'table task is exists.';
//} else {
//    echo 'table task is not exists.';
//}


die();
$tasks = Capsule::table('task')->insert('feodor', 'email', 'description');