<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/api/rest.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/api/todoDAO.php';

    class GetTodo extends Rest{
        public function __construct()
        {
            parent::__construct();
        }
        public function getToDoList(){
            $jsonData = ToDoDAO::retriveToDo();
            if($jsonData!=null)
                $this->returnResponse(200, json_decode($jsonData['data']));
            else
                $this->throwError(404, "Data is not found!");
        }
    }
  
    $obj = new GetTodo();
    $obj->getToDoList();

?>