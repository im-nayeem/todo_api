<?php
namespace ToDo\Helper;

class ResponseHelper
{
    public static function generateResponse($status, $responseCode, $data)
    {
        header("Content-Type: application/json");
        http_response_code($responseCode);
        echo json_encode(["status" => $status, "result" => $data]);
    }
}