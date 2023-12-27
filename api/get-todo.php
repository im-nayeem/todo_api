<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/api/rest.php';

    class GetTodo extends Rest{
        public function __construct()
        {
            parent::__construct();
        }
        public function getToDoList(){
            $jsonData = file_get_contents('task.json');
            $this->returnResponse(200, json_decode($jsonData));
        }
    }
  
    $obj = new GetTodo();
    $obj->getToDoList();


?>