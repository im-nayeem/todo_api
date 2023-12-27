<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/config/config.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/utils.php';
    
    if(!isset($_SESSION))
        session_start();

    class LoginFilter{

        public function __construct()
        {
            
        }
        public static function isValidIssuer($accessToken){
            global $auth;
            $verifiedToken = $auth->verifyIdToken($accessToken, checkIfRevoked:true);
            $iss = $verifiedToken->claims()->get('iss');
            if($iss !== "https://securetoken.google.com/todo-chrome-ext")
                return false;

            if(!isset($_SESSION['user']))
            {
                $user = $auth->getUser($verifiedToken->claims()->get('sub'));
                $userInfo = [
                    "name" => $user->displayName,
                    "email" => $user->email
                ];
                $_SESSION['user'] = $userInfo;
            }
            return true;
        }
        public static function isLoggedIn(){
            global $auth;
            try{
                
                $accessToken = getAccessTokenFromCookie();
                if($accessToken == null)
                {
                    throw new Exception("Not Found!", 404);
                }
                
                if(!LoginFilter::isValidIssuer($accessToken))
                    return false;

                
                }catch(Exception $ex){
                    try{
                        $refreshToken = getRefreshTokenFromCookie();
                      
                      
                        if($refreshToken == null)
                        {
                            return false;
                        }
                        $signInResult = $auth->signInWithRefreshToken($refreshToken);
                       
                        if(!LoginFilter::isValidIssuer($signInResult->accessToken()))
                            return false;
                        
                        setAccessTokenToCookie($signInResult->accessToken());


                    }catch(Exception $e){
                        return false;
                    }
                }
            return true;
        }
        public static function forceLogin(){
            if(!LoginFilter::isLoggedIn())
            {
                header('Location: /account/signin.php');
            }
        }
    }
    
?>