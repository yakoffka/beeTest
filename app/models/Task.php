<?php


namespace App\models;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    protected $guarded = [];
    protected $perPage = 3;
}