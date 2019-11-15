<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Services\EmployeeWebHistoryService;
use Illuminate\Http\Request;

class SetEmpWebHistory extends Command {
	
    protected $signature = 'SET:empwebhistory {ip_address} {url}';    
    protected $description = 'insert employee web history data into employee_web_history table';

    private $employeeWebHistoryServices;

    public function __construct() {
        parent::__construct();
        $this->employeeWebHistoryServices = new EmployeeWebHistoryService();
    }

    public function handle() {
    
		try {
				$request['ip_address'] = $this->argument('ip_address'); 
				$request['url'] = $this->argument('url');
				$output = $this->employeeWebHistoryServices->setData($request);
				$this->line($output);
			} catch(QueryException $exception) {
					$this->error($exception->getMessage());
				}
	}
}