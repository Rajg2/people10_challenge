<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class DeleteEmpData extends Command
{
    protected $signature   = 'UNSET:empdata {ip_address}';    
    protected $description = 'will delete employee data based on input ip address from employee table';

    private $employeeServices;
    private $ip_address;

    public function __construct() {
        parent::__construct();
        $this->employeeServices = new EmployeeService();
    }

      public function handle() {
        
        try {
                $this->ip_address = $this->argument('ip_address'); 
                $output = $this->employeeServices->deleteData($this->ip_address);
                $this->line($output);
            } catch(QueryException $exception) {
                    $this->error($exception->getMessage());
                }
     }
}