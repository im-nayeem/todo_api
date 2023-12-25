<?php
    require_once('constants.php');

    class Rest{
        protected $request;
        protected $serviceName;
        protected $param;

        public function __construct(){
            if($_SERVER['REQUEST_METHOD'] !== "POST")
            {
                $this->throwError(REQUEST_METHOD_NOT_VALID, "Request Method is not valid!");
            }
            $handler = fopen("php://input", "r");
            $this->request = stream_get_contents($handler);
            $this->validateRequest($this->request);
        }

        public function validateRequest(){
            if($_SERVER['CONTENT_TYPE'] !== "application/json"){
                $this->throwError(REQUEST_CONTENTTYPE_NOT_VALID, "Content Type is not valid!");
            }
            $data = json_decode($this->request, true);

            if(!isset($data['name'])){
                $this->throwError(API_NAME_REQUIRED, "API name is required!");
            }
            $this->serviceName = $data['name'];
            if(!isset($data['param'])){
                $this->throwError(API_PARAM_REQUIRED, "API parameter is required!");
            }
            $this->param = $data['param'];
        }
        
        public function processAPI(){

        }
        public function validateParameter($fieldName, $value, $dataType, $isRequired){
            
        }
        public function throwError($errorCode, $message){
            echo json_encode(["status" => $errorCode, "message" => $message]);
            exit;
        }
        public function returnResponse(){

        }
    }
?>