<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmployeeWebHistory extends Model {

	protected $table = 'employee_web_histories';

    protected $fillable = [
        'ip_address', 'url', 'date',
    ];
}
