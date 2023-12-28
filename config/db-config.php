<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

    use Google\Cloud\Firestore\FirestoreClient;
    
    class FirestoreConfig
    {
        private static $instance;
        private $firestore;
        private $collectionReference;
    
        private function __construct()
        {
            $this->firestore = new FirestoreClient([
                "keyFilePath" => $_SERVER["DOCUMENT_ROOT"] . '/config/todo-chrome-ext-firebase-adminsdk-ilufb-b95cbe422f.json',
                "projectId" => "todo-chrome-ext"
            ]);
    
            $this->collectionReference = $this->firestore->collection('todo');
        }
    
        public static function getInstance()
        {
            if(!self::$instance) {
                self::$instance = new self();
            }
    
            return self::$instance;
        }
    
        public function getFirestore()
        {
            return $this->firestore;
        }
    
        public function getCollectionReference()
        {
            return $this->collectionReference;
        }
    }
    
    $firestoreConfig = FirestoreConfig::getInstance();
    $firestore = $firestoreConfig->getFirestore();
    $collectionRef = $firestoreConfig->getCollectionReference();
    
?>