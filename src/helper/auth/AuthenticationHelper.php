<?php
namespace ToDo\Helper\Auth;

use Throwable;
use ToDo\Config\AppConfig;
use ToDo\Utils\Utils;
use ToDo\Context\AuthContext;

class AuthenticationHelper {
    public static function isVerifiedEmail($email)
    {
        try {
            $auth = AuthContext::getInstance();
            $user = $auth->getUserByEmail($email)->emailVerified;
            if($user) {
                return true;
            }
        } catch(Throwable $ex) {
            Utils::log_error($ex->getMessage());
            return false;
        }
    }

    public static function hasValidAccessToken()
    {
        $auth = AuthContext::getInstance();
        try{
            $accessToken = self::getAccessTokenFromHeader();
            $verifiedToken = $auth->verifyIdToken($accessToken, true);
            $iss = $verifiedToken->claims()->get('iss');
            if($iss !== AppConfig::TOKEN_ISSUER)
                return false;
            
            self::setUserSession($verifiedToken);
            return true;
        } catch(Throwable  $ex) {
            Utils::log_error($ex->getMessage());
            return false;
        }
    }

    public static function refreshAccessToken()
    {
        $auth = AuthContext::getInstance();
        try {
            $refreshToken = self::getRefreshToken();
            if($refreshToken == null) {
                return null;
            }
            $signInResult = $auth->signInWithRefreshToken($refreshToken);
            return $signInResult->accessToken();
        } catch (Throwable $ex) {
            log_error($ex->getMessage());
            return null;
        }
    }

    private static function getRefreshToken()
    {
        if(isset($_COOKIE['ref_token']))
            return $_COOKIE['ref_token'];
        else
            return null;
    }

    private static function getAccessTokenFromHeader()
    {
        if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            $authHeader = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        } else {
            return null; 
        }
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            echo $matches[1]; 
        }
        return null;
    }

    private static function setUserSession($verifiedToken)
    {
        if(!isset($_SESSION))
            session_start();
        if(!isset($_SESSION['user']))
        {
            global $auth;
            $user = $auth->getUser($verifiedToken->claims()->get('sub'));
            $userInfo = [
                "name" => $user->displayName,
                "email" => $user->email,
                "uid" => $verifiedToken->claims()->get('sub')
            ];
            $_SESSION['user'] = $userInfo;
        }
    } 

}