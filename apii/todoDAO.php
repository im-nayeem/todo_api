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
        /**
         * store tasklist in firestore
         * @param $todos array(taskList) of json objects(tasks)
         */
        public static function storeToDo($todos){
            global $collectionRef;
            $document = $collectionRef->document($_SESSION['user']['email']);
            $document->set([
                "data" => $todos
            ]);
        }
        /**
         * @param $email user email
         */
        public static function createDocument($email){
            global $collectionRef;
            $document = $collectionRef->document($email);
            $document->set([
                "data" => json_encode(["updateTime" => time(), "todo" => null])
            ]);
        }
    }
?>