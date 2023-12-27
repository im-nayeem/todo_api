<?php
    /**
     * @param $error_message the error messages to log on error.log file
     */
    function log_error($error_message){
        date_default_timezone_set('Asia/Dhaka');
        $currentDateTime = date('Y-m-d H:i:s');
        error_log($error_message.PHP_EOL.$currentDateTime.PHP_EOL.PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT']."/error/error.log");
    }

    function getRefreshTokenFromCookie(){
        if(isset($_COOKIE['ref_token']))
            return $_COOKIE['ref_token'];
        else
            return null;
    }
    function getAccessTokenFromCookie(){
        if(isset($_COOKIE['access_token']))
            return $_COOKIE['access_token'];
        else
            return null;
    }
    function setAccessTokenToCookie($token){
        setcookie('access_token', $token, time() + 30*24*3600, '/', '',  httponly:true);
    }
    function setRefreshTokenToCookie($token){
        setcookie('ref_token', $token, time() + 30*24*3600, '/', '',  httponly:true);
    }
    function resetTokenInCookie(){
        setcookie('access_token', "", time() - 3600, '/', '',  httponly:true);
        setcookie('ref_token', "", time() - 3600, '/', '',  httponly:true);
    }

?>