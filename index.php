<?php

use ToDo\Api\Auth\RefreshAccessToken;
use ToDo\Helper\ResponseHelper;
use ToDo\Middleware\AuthMiddleware;
use ToDo\Middleware\ExceptionHandlingMiddleware;
use ToDo\Middleware\LogMiddleware;
use ToDo\Pipeline\MiddlewarePipeline;
use ToDo\ResponseStatus;

header("Access-Control-Allow-Origin: http://127.0.0.1/*");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE");

require_once 'vendor/autoload.php';

$pipeline = MiddlewarePipeline::getInstance();
$pipeline->add(ExceptionHandlingMiddleware::getInstance());
$pipeline->add(LogMiddleware::getInstance());
$pipeline->add(AuthMiddleware::getInstance()); 

$next = function() {
    if ($_SERVER['REQUEST_URI'] === '/home') {
        echo "Welcome to the Home page!";
    } else if($_SERVER['REQUEST_URI'] === '/ap/refresh-access-token') {  
        $obj = new RefreshAccessToken();
        $accessToken = $obj->getResponse();
        ResponseHelper::generateResponse(ResponseStatus::OK, SUCCESS_RESPONSE, $accessToken);

    }
};

$pipeline->handle($next);
