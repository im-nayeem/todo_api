<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/config/db-config.php';

    class ToDoDAO{
        public static function retriveToDo(){
            global $collectionRef;
            $document = $collectionRef->document($_SESSION['user']['email']);
            $snapshot = $document->snapshot();
            if($snapshot->exists())
                return $snapshot->data();
            else 
                return null;
        }
        public static function storeToDo($todos){
            global $collectionRef;
            $document = $collectionRef->document($_SESSION['user']['email']);
            $document->set([
                "time" => time(),
                "data" => $todos
            ]);
        }
        public static function createDocument($email){
            global $collectionRef;
            $document = $collectionRef->document($email);
            $data = ["timestamp" => '12:00 PM', "task" => "Do this"];
            $document->set([
                "time" => time(),
                "data" => ""
            ]);
        }
    }
?>