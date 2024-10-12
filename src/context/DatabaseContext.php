<?php
namespace ToDo\Context;

require_once 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;
use ToDo\Config\AppConfig;

class DatabaseContext
{
    private static $instance;
    private static $firestore;

    private function __construct()
    {
        self::$firestore = new FirestoreClient([
            "keyFilePath" => $_SERVER["DOCUMENT_ROOT"] . '/src/config/todo-chrome-ext-firebase-adminsdk-ilufb-b95cbe422f.json',
            "projectId" => AppConfig::PROJECT_ID
        ]);
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }

        return self::$firestore;
    }

    public function getCollectionRef($collectionId)
    {
        return $this->firestore->collection($collectionId);
    }

    public function getDocRef()
    {

    }

    public function getAllDocs($collectionId)
    {

    }
}
