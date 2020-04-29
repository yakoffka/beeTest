<?php

use App\controllers\UserController;
use App\databases\CapsuleInstance;
use App\databases\migrations\TasksMigration;
use App\databases\migrations\UserMigration;
use App\models\User;

echo 'hello, i am file ' . __FILE__ . "\n<br>";

require 'config.php';
require 'vendor/autoload.php';


$capsule = new CapsuleInstance();

$taskMigration = new TasksMigration();
$taskMigration->down();
$taskMigration->up();


$userMigration = new UserMigration();
$userMigration->down();
$userMigration->up();


UserController::create('Admin', 'email@site.com', '123');


