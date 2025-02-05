<?php

require_once 'vendor/autoload.php';

use ToDo\AbstractExecutor;
use ToDo\Api\Auth\Login;
use ToDo\Api\Auth\RefreshAccessToken;
use ToDo\Helper\ResponseHelper;
use ToDo\Home\Home;
use ToDo\Middleware\AuthMiddleware;
use ToDo\Middleware\ExceptionHandlingMiddleware;
use ToDo\Middleware\LogMiddleware;
use ToDo\Pipeline\MiddlewarePipeline;
use ToDo\Repository\TodoRepository;

header("Access-Control-Allow-Origin: http://127.0.0.1/*");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");


$pipeline = MiddlewarePipeline::getInstance();
$pipeline->add(ExceptionHandlingMiddleware::getInstance());
$pipeline->add(LogMiddleware::getInstance());
$pipeline->add(AuthMiddleware::getInstance()); 

$execute = function(AbstractExecutor $obj) {
    $response = $obj->execute();
    ResponseHelper::generateResponse($response);
};

$next = function() use ($execute) {
    if ($_SERVER['REQUEST_URI'] === '/home' || $_SERVER['REQUEST_URI'] === '/') {
        $execute(new Home());
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/refresh-access-token') {  
        $execute(new RefreshAccessToken());
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/reset-password') {
        
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/signup') {
        $obj = new TodoRepository();
        $obj->createTodo('nayeem', null);
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/login') {
        $execute(new Login());
    } else {
        echo "404 Not Found!";
    }
};

$pipeline->handle($next);

?>
