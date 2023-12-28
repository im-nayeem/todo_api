<?php
    require $_SERVER["DOCUMENT_ROOT"] . '/vendor/autoload.php';
    use Kreait\Firebase\Factory;
    
    class Config
    {
        private static $instance;
        private $auth;

        private function __construct()
        {
            $factory = (new Factory)->withServiceAccount($_SERVER["DOCUMENT_ROOT"] .'/config/todo-chrome-ext-firebase-adminsdk-ilufb-b95cbe422f.json');
            $this->auth = $factory->createAuth();
        }

        public static function getInstance()
        {
            if(!self::$instance) {
                self::$instance = new self();
            }
            return self::$instance;
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

    $firebaseAuth = Config::getInstance();
    $auth = $firebaseAuth->getAuth();

?>
