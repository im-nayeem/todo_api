<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/api/rest.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/todoDAO.php';

    class UpdateTodo extends Rest{
        protected $data;
        public function __construct()
        {
            parent::__construct();
           
            $this->data = file_get_contents("php://input");
            $this->validateRequest($this->data);
            
        }
        public function updateToDo()
        {
            ToDoDAO::storeToDo($this->data);
            $this->returnResponse(200, "Successfull");
        }
    }
    $obj = new UpdateTodo();
    $obj->updateToDo();

?>