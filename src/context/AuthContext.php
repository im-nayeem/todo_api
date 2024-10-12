<?php
namespace ToDo\Context;

require_once 'vendor/autoload.php';
use Kreait\Firebase\Factory;
    
class AuthContext
{
    private static $instance;
    private $auth;

    private function __construct()
    {
        $factory = (new Factory)->withServiceAccount($_SERVER["DOCUMENT_ROOT"] .'/src/config/todo-chrome-ext-firebase-adminsdk-ilufb-b95cbe422f.json');
        $this->auth = $factory->createAuth();
    }

    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance->auth;
    }

    public function getAuth()
    {
        return $this->auth;
    }

    private function __clone()
    {
        // prevent to clone instance
    }
}

// $firebaseAuth = AuthContext::getInstance();
// $auth = $firebaseAuth->getAuth();

?>
