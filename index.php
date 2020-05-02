<?php

use App\databases\CapsuleInstance;
use App\routes\Route;

require 'config.php';
require 'vendor/autoload.php';

session_start();

$capsule = new CapsuleInstance();

$vars = Route::start();

include __DIR__ . '/app/views/layouts/app.php';

