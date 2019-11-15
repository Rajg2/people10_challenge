<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\EmployeeWebHistoryService;

class EmployeeWebHistoryController extends Controller {
	
	private $employeeWebHistoryServices;

    public function __construct() {
    	$this->employeeWebHistoryServices = new EmployeeWebHistoryService();
    }

    public function store(Request $request) {
    	return $this->employeeWebHistoryServices->setData($request);
    }

    public function show($ip_address) {
		return $this->employeeWebHistoryServices->getData($ip_address);    	
    }

    public function destroy($ip_address) {
        return $this->employeeWebHistoryServices->deleteData($ip_address) ;
    }
	
}
