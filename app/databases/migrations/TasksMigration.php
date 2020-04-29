<?php


namespace App\databases\migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migration;

class TasksMigration extends Migration
{
    public $table = 'tasks';

    public function up()
    {
        Capsule::schema()->create($this->table, function ($table) {
            $table->increments('id');
            $table->string('user_name');
            $table->string('email');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop($this->table);
    }

}