<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class GetEmpData extends Command {

    protected $signature = 'GET:empdata {ip_address}';    
    protected $description = 'get particular employee detail from emplyees table';

    private $employeeServices;
    private $ip_address;

    public function __construct() {
        parent::__construct();
        $this->employeeServices = new EmployeeService();
    }

    public function handle() {

        try {
                $this->ip_address = $this->argument('ip_address'); 
                $output = $this->employeeServices->getData($this->ip_address);
                $this->line($output);
            } catch(QueryException $exception) {
                    $this->error($exception->getMessage());
                }
    }
}