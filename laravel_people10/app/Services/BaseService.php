<?php

namespace App\Services;
use Response;
use \Illuminate\Http\Response as Res;

class BaseService
{
   protected $statusCode = Res::HTTP_OK;
    
    public function getStatusCode()
    {
        return $this->statusCode;
    }    
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    public function respondCreated($message = 'Record Created Successfully', $data=null){
        return $this->respond([
            'status' => 'success',
            'status_code' => Res::HTTP_CREATED,
            'message' => $message
        ]);
    }    
    public function respondNotFound($message = 'Not Found!'){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_NOT_FOUND,
            'message' => $message,
        ]);
    }
    public function respondInternalError($message){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_INTERNAL_SERVER_ERROR,
            'message' => $message,
        ]);
    }
    public function respondValidationError($message, $errors){
        return $this->respond([
            'status' => 'error',
            'status_code' => Res::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message,
            'data' => $errors
        ]);
    }    	
	public function respond($data){
        return Response::json($data, $this->getStatusCode());
    }
}
