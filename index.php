<?php

use ToDo\Api\Auth\Login;
use ToDo\Api\Auth\RefreshAccessToken;
use ToDo\Helper\ResponseHelper;
use ToDo\Middleware\AuthMiddleware;
use ToDo\Middleware\ExceptionHandlingMiddleware;
use ToDo\Middleware\LogMiddleware;
use ToDo\Pipeline\MiddlewarePipeline;
use ToDo\Repository\TodoRepository;
use ToDo\ResponseStatus;

header("Access-Control-Allow-Origin: http://127.0.0.1/*");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");

require_once 'vendor/autoload.php';

$pipeline = MiddlewarePipeline::getInstance();
$pipeline->add(ExceptionHandlingMiddleware::getInstance());
$pipeline->add(LogMiddleware::getInstance());
$pipeline->add(AuthMiddleware::getInstance()); 

$execute = function($obj) {
    $response = $obj->getResponse();
    ResponseHelper::generateResponse(ResponseStatus::OK, SUCCESS_RESPONSE, $response);
};

$next = function() use ($execute) {
    if ($_SERVER['REQUEST_URI'] === '/home') {
        echo "Welcome to the Home page!";
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/refresh-access-token') {  
        $execute(new RefreshAccessToken());
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/reset-password') {
        
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/signup') {
        $obj = new TodoRepository();
        $obj->createTodo('nayeem', null);
    } else if($_SERVER['REQUEST_URI'] === '/api/auth/login') {
        $execute(new Login());
    }
};

$pipeline->handle($next);

?>
