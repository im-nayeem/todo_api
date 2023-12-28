<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/constants.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/utils.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/login-filter.php';


    header("Access-Control-Allow-Origin: http://127.0.0.1/*");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");

    class Rest{
        protected $data;

        public function __construct(){
            if($_SERVER['REQUEST_METHOD'] !== "POST" && $_SERVER['REQUEST_METHOD'] !== "GET")
                $this->throwError(REQUEST_METHOD_NOT_VALID, "Request Method is not valid!");
            if(!LoginFilter::isLoggedIn())
                $this->throwError(UNAUTHORIZED_ACCESS, "Unauthorized Access!");
            
        }

        public function validateRequest($data){
            if($_SERVER['CONTENT_TYPE'] !== "application/json"){
                $this->throwError(REQUEST_CONTENT_NOT_VALID, "Content Type is not valid!");
            }
            $decodedData = json_decode($data);
            if($decodedData === null || !is_array($decodedData)) {
                $this->throwError(REQUEST_CONTENT_NOT_VALID, "Content is not a valid JSON array!");
            }
            foreach($decodedData as $item) {
                if (!is_object($item)) {
                    $this->throwError(REQUEST_CONTENT_NOT_VALID, "Each element in the array must be a JSON object!");
                }
            }
        }

        public function throwError($errorCode, $message){
            echo json_encode(["status" => $errorCode, "message" => $message]);
            exit;
        }
        
        public function returnResponse($status, $result){
            echo json_encode(["status" => $status, "result" => $result]);
        }
    }
?>