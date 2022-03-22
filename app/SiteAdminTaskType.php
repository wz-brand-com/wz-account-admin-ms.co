<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteAdminTaskType extends Model
{
    protected $connection = 'mysqlSiteAdminTaskType';
    protected $table = 'task_types';
}
