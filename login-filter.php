<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/config/config.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/utils.php';
    
    if(!isset($_SESSION))
        session_start();

    class LoginFilter{

        public function __construct()
        {
            
        }

        public static function isLoggedIn(){
            try{
                global $auth;
                $refreshToken = getTokenFromCookie();
                if($refreshToken == null)
                {
                    return false;
                }
                $signInResult = $auth->signInWithRefreshToken($refreshToken);
                $verifiedToken = $auth->verifyIdToken($signInResult->idToken(), checkIfRevoked:true);
        
                $iss = $verifiedToken->claims()->get('iss');
                if($iss !== "https://securetoken.google.com/todo-chrome-ext")
                    return false;
                
                if(!isset($_SESSION['uid']))
                    $_SESSION['uid'] =  $verifiedToken->claims()->get('sub');
            
                }catch(Exception $e){
                    return false;
                }
            return true;
        }
        public static function forceLogin(){
            if(!LoginFilter::isLoggedIn())
            {
                header('Location: /login.php');
            }
        }
    }
    
?>