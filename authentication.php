<?php
    require_once('./config.php');

    $user = $auth->getUserByEmail('hnayeem520@gmail.com');
    echo (!$user->emailVerified);
    $signInRes = $auth->signInWithEmailAndPassword('hnayeem520@gmail.com', 'nayeem123');
    $token = $signInRes->idToken();

    echo $token;
?>

