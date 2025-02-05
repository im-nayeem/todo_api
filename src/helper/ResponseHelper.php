<?php
namespace ToDo\Helper;

use ToDo\Models\Response;

class ResponseHelper
{
    public static function generatePage($response): void
    {
        header("Content-Type: text/html");
        http_response_code($response->getResponseCode());
        if($response->getData())
        {
            echo $response->getData();
            return;
        }
        include $response->getFilePath();
    }

    public static function generateResponse(Response $response): void
    {
        if($response->isHtmlContent())
        {
            self::generatePage($response);
            return;
        }
        header("Content-Type: application/json");
        http_response_code($response->getResponseCode());
        echo json_encode(["status" => $response->getStatus(), "result" => $response->getData()]);
    }
}