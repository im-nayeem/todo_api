<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/api/rest.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/api/todoDAO.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/login-filter.php';

    class GetUser extends Rest{
        public function __construct()
        {
            if(!isset($_SESSION['user']))
                LoginFilter::forceLogin();
            parent::__construct();
        }
        public function getUserInfo(){
            $jsonData = json_encode(
                ['name' => $_SESSION['user']['name'] , 'email' => $_SESSION['user']['email']]
            );

            if($jsonData!=null)
                $this->returnResponse(200, json_decode($jsonData));
            else
                $this->throwError(404, "Data is not found!");
        }
    }
    
    $obj = new GetUser();
    $obj->getUserInfo();

?>