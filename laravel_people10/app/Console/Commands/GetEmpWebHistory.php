<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmployeeWebHistoryService;
use Illuminate\Http\Request;

class GetEmpWebHistory extends Command {
	
    protected $signature = 'GET:empwebhistory {ip_address}';    
    protected $description = 'get particular employee web history detail from employee_web_history table';

    private $employeeWebHistoryServices;
    private $ip_address;

    public function __construct() {
        parent::__construct();
        $this->employeeWebHistoryServices = new EmployeeWebHistoryService();
    }

    public function handle() {
        
		try {
				$this->ip_address = $this->argument('ip_address'); 
				$output = $this->employeeWebHistoryServices->getData($this->ip_address);
				$this->line($output);
			}catch(QueryException $exception){
					$this->error($exception->getMessage());
				}
    }
	
}