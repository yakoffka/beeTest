<?php


namespace App\models;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    protected $guarded = [];
    public static $chunk = TASK_CHUNK;

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return with(new static)->getTable();
    }
}