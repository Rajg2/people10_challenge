<?php

namespace App\Services;

use Illuminate\Http\Request;
use Validator;
use App\Employees;
use \Illuminate\Http\Response as Res;

class EmployeeService extends BaseService {

    public function __construct() {

    }

    public function setData($request) {

        $validator = Validator::make( [
                            'emp_id' => $request['emp_id'],
                            'emp_name' => $request['emp_name'],
                            'ip_address' => $request['ip_address'],
                        ], [ 
                        'emp_id' => 'required|unique:Employees,emp_id',
                        'emp_name' => 'required|max:150',
                        'ip_address' => 'required|unique:Employees,ip_address',
                    ]);

        if($validator->fails()) {
            return $this->respondValidationError('Input Parmeter Validation Failed.', $validator->errors());
        }

        try {
                $employe['emp_id'] = $request['emp_id'];
                $employe['emp_name'] = $request['emp_name'];
                $employe['ip_address'] = $request['ip_address'];
                Employees::create($employe);
                return $this->respondCreated('Employee Added Successfully');
        } catch(Employees $e) {
            return $this->respondInternalError("An error occurred while performing an action!");
        }
    }

    public function getData($ip_address) {

        try {
                $employee = Employees::where('ip_address',$ip_address)->first();
                
                if($employee) {
                    return $this->respond([
                                    'status' => 'success',
                                    'status_code' => $this->getStatusCode(),
                                    'message' => 'Success',
                                    'employee'=>$this->toArray($employee)
                                ]);
                } else {
                        return $this->respondNotFound();
                    } 

            } catch(Employees $e) {
                    return $this->respondInternalError("An error occurred while performing an action!");
                }
    }

    public function deleteData($ip_address) {

        try {
                $deleteEmployee = Employees::where('ip_address',$ip_address)->delete();
                if($deleteEmployee)
                {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Deleted',
                    ]); 
                } else {
                    return $this->respondNotFound();
                }

            } catch(Employees $e) {
                    return $this->respondInternalError("An error occurred while performing an action!");
                }
    }

    private function toArray($inputData,$dataArr=array()) {

        $dataArr['id']           = $inputData->id;
        $dataArr['empId']        = $inputData->emp_id;
        $dataArr['empName']      = $inputData->epm_name;
        $dataArr['empIpAddress'] = $inputData->ip_address;
        return $dataArr;

    }

}