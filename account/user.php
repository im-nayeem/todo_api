<?php 
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; 
    require_once $_SERVER['DOCUMENT_ROOT'].'/utils.php';
   
    if(!isset($_SESSION))
        session_start();
   
    try{
        if(isset($_GET['t']))
        {
            if($_GET['t'] == "logout")
            {
                $auth->revokeRefreshTokens($_SESSION['user']['uid']);
                resetTokenInCookie();
                $_SESSION['user'] = null;
                header('Location: /account/signin.php');
            }
            elseif($_GET['t'] == "reset_password")
            {
                if(isset($_GET['email']))
                {
                    $auth->sendPasswordResetLink($_GET['email']);
                    echo "Check your mail and visit the password reset link to reset your password.";
                }
            }
        }
    }catch(Exception $e)
    {
        log_error($e->getMessage());
        header('Location: /error/error.php');
    }

?>

