<?php
    require_once $_SERVER["DOCUMENT_ROOT"].'/config/config.php';
    require_once $_SERVER["DOCUMENT_ROOT"].'/utils.php';
    
    try{

        if(!($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)))
            throw new Exception("Error Processing Request");
        

        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        if(!$auth->getUserByEmail($email)->emailVerified)
        {
            $page = "/signin.php?error_msg=Your email is not verified! Check your mail to verify you email address. You can login after email verification.";
            header('Location: '.$page);

        }
        else{
            try{
                
                $signInResult = $auth->signInWithEmailAndPassword($email, $pass);
                $refreshToken = $signInResult->refreshToken();
                setAccessTokenToCookie($signInResult->accessToken());
                setRefreshTokenToCookie($signInResult->refreshToken());
                header('Location: /');

            }catch(Exception $e)
            {
                log_error($e);
                $errPage = "/signin.php?error_msg=Wrong email or password!";
                header('Location: '.$errPage);
            }
        }
    } catch(Exception $e){
            log_error($e);
            $errPage = "/error/error.php?error_msg=Error occured while login.";
            header('Location: '.$errPage);
    }
?>

