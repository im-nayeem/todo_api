<?php
namespace ToDo\Api\Auth;

use Exception;
use Throwable;
use ToDo\Api\AbstractRest;
use ToDo\Context\AuthContext;
use ToDo\Helper\Auth\AuthenticationHelper;
use ToDo\Service\AuthenticationService;

class Login extends AbstractRest
{
    private ?AuthenticationService $authService = null;
    
    public function __construct()
    {
        $this->authService = AuthenticationService::getInstance();    
    }
    private function authenticate($email, $pass)
    {
        try {
            if(!AuthenticationHelper::isVerifiedEmail($email))
            {
                return 
                ["error" => "Your email is not correct or verified. If your email is correct then check your mail to verify your email address."];
            }
            $signInResult = $auth->signInWithEmailAndPassword($email, $pass);
            $accesToken = $signInResult->accessToken();
            if($accesToken == null) {
                $accesToken = $signInResult->idToken();
            }
            $refreshToken = $signInResult->refreshToken();
            return
            [
                "access_token" => $accesToken,
                "refresh_token" => $refreshToken
            ];
        } catch(Throwable $ex) {
            return ["error" => "Incorrect password!"];
        }
    }
    private function generateToken()
    {
        if(!($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)))
            throw new Exception("Error Processing Request");
        $email = $_POST['email'] ?? null;
        $pass = $_POST['password'] ?? null;
        // $email = "hnayeem520@gmail.com";
        // $pass = "";
        return self::authenticate($email, $pass);
    }
    public function getResponse()
    {
        return self::generateToken();
    }
}
?>