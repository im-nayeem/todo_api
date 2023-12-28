<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/api/rest.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/api/todoDAO.php';

    class UpdateTodo extends Rest{
        protected $data;
        public function __construct()
        {
            parent::__construct();
           
            $file = fopen("php://input", "r");
            $this->data = stream_get_contents($file);

            $this->validateRequest($this->data);
        }
        public function updateToDo()
        {
            ToDoDAO::storeToDo($this->data);
        }
    }

?>