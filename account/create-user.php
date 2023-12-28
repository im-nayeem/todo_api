<?php
    require_once($_SERVER["DOCUMENT_ROOT"].'/config/config.php');
    require_once($_SERVER["DOCUMENT_ROOT"].'/utils.php');
    require_once($_SERVER["DOCUMENT_ROOT"].'/api/todoDAO.php');

    try{
            if(!($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST)))
                throw new Exception("Error Processing Request", 1);
                
            $name = $_POST['name'];
            $email = $_POST['email'];
            $pass = $_POST['password'];

            $userProperties = [
                'email' => $email,
                'emailVerified' => false,
                'password' => $pass,
                'displayName' => $name,
            ];
           
            $createdUser = $auth->createUser($userProperties);
            $auth->sendEmailVerificationLink($email, null, null);

            if($createdUser){
                ToDoDAO::createDocument($email);
                $page = "/account/signin.php?msg=User account is created successfully. Check your mail to verify your e-mail address. You can login after email verification.";
                header('Location: '.$page);
            }
            else{
                $page = "/account/signup.php?msg=User account is not created. Try again!";
                header('Location: '.$page);
            }

    } catch(Kreait\Firebase\Exception\Auth\EmailExists $e){
        log_error($e);
        $errPage = "/account/signup.php?msg=User account is already created with this email! Try with different email.";
        header('Location: '.$errPage);
    } 
    catch(Exception $e){
            log_error($e);
            $errPage = "/error/error.php?error_msg=Error occured while creating new user.";
            header('Location: '.$errPage);
    }
?>