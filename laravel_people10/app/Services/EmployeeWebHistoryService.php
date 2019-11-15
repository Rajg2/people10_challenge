<?php

namespace App\Services;

use Illuminate\Http\Request;
use Validator;
use App\Employees;
use App\EmployeeWebHistory;
use \Illuminate\Http\Response as Res;
use Carbon\Carbon;

class EmployeeWebHistoryService extends BaseService {

    public function __construct() {
        $this->employeeTbl      = 'employees';
        $this->empWebHistoryTbl = 'employee_web_histories';
    }

    public function setData($request) {

        $validator = Validator::make( [
                            'ip_address' => $request['ip_address'],
                            'url'        => $request['url'],
                        ], [ 
                                'ip_address' => 'required',
                                'url'        => 'required',
                            ]
                    );

        if($validator->fails()) {
            return $this->respondValidationError('Input Parmeter Validation Failed.', $validator->errors());
        }

        $findEmployee = $this->findEmployee($request['ip_address']);

        if($findEmployee) {

            try {
                    $employeeWebHistory['ip_address'] = $request['ip_address'];
                    $employeeWebHistory['url'] = $request['url'];
                    $employeeWebHistory['date'] = Carbon::now();
                    EmployeeWebHistory::create($employeeWebHistory);
                    return $this->respondCreated('Employee History Added Successfully');
                } catch(EmployeeWebHistory $e) {
                        return $this->respondInternalError("An error occurred while performing an action!");
                    }
            } else {
                return $this->respondNotFound($message = 'Resource not found');
            }
    }

    public function getData($ip_address) {            

        try {
                $employeeWebHistory = EmployeeWebHistory::join($this->employeeTbl, $this->employeeTbl.'.ip_address','=',$this->empWebHistoryTbl.'.ip_address')
                    ->select($this->empWebHistoryTbl.'.url',$this->employeeTbl.'.ip_address',$this->employeeTbl.'.id')
                    ->where($this->empWebHistoryTbl.'.ip_address', $ip_address)
                    ->get();

                if(isset($employeeWebHistory[0])) {
                    return $this->respond([
                        'status' => 'success',
                        'status_code' => $this->getStatusCode(),
                        'message' => 'Success',
                        'employeewebhistory'=>$this->toArray($employeeWebHistory)
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
                $deleteEmpWebHistory = EmployeeWebHistory::where('ip_address',$ip_address)->delete();
                
                if($deleteEmpWebHistory) {
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

    private function findEmployee($ip_address) {

        try {
                $employee = Employees::where('ip_address',$ip_address)->first();

                if($employee) {
                    return true;
                } else {
                        return false;
                    }

            } catch(Employees $e) {
                    return $this->respondInternalError("An error occurred while performing an action!");
                }
    }
    private function toArray($inputData,$dataArr=array()) {

        $dataArr['id']           = $inputData[0]->id;
        $dataArr['empIpAddress'] = $inputData[0]->ip_address;
        foreach ($inputData as $key => $value) {
            $dataArr['urls'][] = array('url'=>$value->url);
        }        
        return $dataArr;
    }

}