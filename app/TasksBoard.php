<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksBoard extends Model
{
    protected $connection = 'mysqlTASKS_BOARD';
    protected $table = 'task_boards';
}
