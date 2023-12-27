<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/api/rest.php';

    class UpdateTodo extends Rest{
        public function __construct()
        {
            parent::__construct();
           
            $file = fopen("php://input", "r");
            $this->data = stream_get_contents($file);
            $this->validateRequest();
        }
    }

?>