<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class SetEmpData extends Command {

    protected $signature = 'SET:empdata {emp_id} {emp_name} {ip_address}';    
    protected $description = 'insert employee data into emplyees table';

    private $employeeServices;

    public function __construct() {
        parent::__construct();
        $this->employeeServices = new EmployeeService();
    }

    public function handle() {
        
        try {
                $request['emp_id'] = $this->argument('emp_id'); 
                $request['emp_name'] = $this->argument('emp_name');
                $request['ip_address'] = $this->argument('ip_address'); 
                $output = $this->employeeServices->setData($request);
                $this->line($output);
            } catch(QueryException $exception) {
                     $this->error($exception->getMessage());
                }
    }
}