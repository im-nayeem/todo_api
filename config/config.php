<?php

    require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\Contract\Auth;
    
    $factory = (new Factory)->withServiceAccount('todo-chrome-ext-firebase-adminsdk-ilufb-b95cbe422f.json');

    $auth = $factory->createAuth();

?>