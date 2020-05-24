<?php


namespace App\databases\migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

class UserMigration extends Migration
{
    public $table = 'users';

    public function up()
    {
        Capsule::schema()->create($this->table, function ($table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists($this->table);
    }

}