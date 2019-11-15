<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\EmployeeService;

class EmployeeController extends Controller {

	private $employeeServices;

    public function __construct() {
    	$this->employeeServices = new EmployeeService();
    }

    public function store(Request $request) {
    	return $this->employeeServices->setData($request);
    }

    public function show($ip_address) {
		return $this->employeeServices->getData($ip_address);    	
    }

    public function destroy($ip_address) {
        return $this->employeeServices->deleteData($ip_address) ;
    }

}
