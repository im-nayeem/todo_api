<?php
namespace ToDo\Api\Auth;

use Exception;
use ToDo\Api\AbstractRest;

class Login extends AbstractRest
{
    private function authenticate()
    {

    }
    private function generateToken()
    {
        if(!($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)))
            throw new Exception("Error Processing Request");
        self::authenticate();
    }
    public function getResponse()
    {
        
    }
}