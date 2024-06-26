<?php

use Kreait\Firebase\Exception\Auth\UserNotFound;

    require_once $_SERVER["DOCUMENT_ROOT"].'/config/config.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/utils.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/login-filter.php';

    
    try{

        if(!($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)))
            throw new Exception("Error Processing Request");
        

        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        if(!$auth->getUserByEmail($email)->emailVerified)
        {
            $page = "/account/signin.php?error_msg=Your email is not verified! Check your mail to verify you email address. You can login after email verification.";
            header('Location: '.$page);

        }
        else{
            try{
                
                $signInResult = $auth->signInWithEmailAndPassword($email, $pass);
                $accesToken = $signInResult->accessToken();
                $refreshToken = $signInResult->refreshToken();
                log_error($accesToken);
                log_error($refreshToken);
                setAccessTokenToCookie($accesToken);
                setRefreshTokenToCookie($refreshToken);
                LoginFilter::isLoggedIn();
                header('Location: /');

            }catch(Exception $e)
            {
                log_error($e);
                $errPage = "/account/signin.php?error_msg=Wrong email or password!";
                header('Location: '.$errPage);
            }
        }
    } catch(UserNotFound $ex)
    {
        log_error($e);
        $errPage = "/account/signin.php?error_msg=User not found! Please sign up to continue.";
        header('Location: '.$errPage);
    }
     catch(Exception $e){
            log_error($e);
            $errPage = "/error/error.php?error_msg=Error occured while login.";
            header('Location: '.$errPage);
    }
?>

