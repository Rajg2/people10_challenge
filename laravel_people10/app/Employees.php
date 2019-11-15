<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model {

	protected $table = 'employees';
	
    protected $fillable = [
        'emp_id', 'emp_name', 'ip_address',
    ];

}
