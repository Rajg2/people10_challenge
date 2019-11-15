<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmployeeWebHistoryService;
use Illuminate\Http\Request;

class DeleteEmpWebHistory extends Command {
	
    protected $signature = 'UNSET:empwebhistory {ip_address}';    
    protected $description = 'will delete employee web history data based on input ip address from employee_web_history table';
	
    private $employeeWebHistoryServices;
    private $ip_address;

    public function __construct() {
        parent::__construct();
        $this->employeeWebHistoryServices = new EmployeeWebHistoryService();
    }

    public function handle() {
    
		try {
				$this->ip_address = $this->argument('ip_address'); 
				$output = $this->employeeWebHistoryServices->deleteData($this->ip_address);
				$this->line($output);
			} catch(QueryException $exception) {
					$this->error($exception->getMessage());
				}
		}
}