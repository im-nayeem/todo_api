<?php
namespace ToDo\Api\Auth;

use Exception;
use Throwable;
use ToDo\Api\AbstractRest;
use ToDo\Models\Response;
use ToDo\Service\AuthenticationService;
use ToDo\Utils\Utils;

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
            if(!$this->authService->isVerifiedEmail($email))
            {
                return 
                ["error" => "Your email is not correct or verified. If your email is correct then check your mail to verify your email address."];
            }
            return $this->authService->signInWithEmailAndPassword($email, $pass);
        } catch(Throwable $ex) {
            Utils::log_error($ex->getMessage());
        }
    }
    private function generateToken()
    {
        // if(!($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)))
        //     throw new Exception("Error Processing Request");
        $email = $_POST['email'] ?? null;
        $pass = $_POST['password'] ?? null;
        $email = "hnayeem520@gmail.com";
        $pass = "im-nayeem02";
        return self::authenticate($email, $pass);
    }
    public function getResponse(): Response 
    {
        $token = self::generateToken();
        return new Response(data: $token);
    }
}
?>