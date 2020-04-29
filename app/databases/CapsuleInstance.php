<?php


namespace App\databases;


use Illuminate\Database\Capsule\Manager as Capsule;

class CapsuleInstance
{
    public function __construct()
    {
        $capsule = new Capsule();

        $capsule->addConnection([
            'driver'    => DB_DRIVER,
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->bootEloquent();

        echo 'hello, i am ' . __CLASS__ . "\n<br>";
    }

}