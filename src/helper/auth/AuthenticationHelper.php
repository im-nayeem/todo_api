<?php
namespace ToDo\Helper\Auth;

class AuthenticationHelper
{
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
}