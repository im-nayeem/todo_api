<?php
namespace ToDo\Home;

use ToDo\Api\AbstractRest;
use ToDo\Models\Response;
use ToDo\ResponseStatus;
use ToDo\Utils\Utils;

class Home extends AbstractRest
{

    protected function getResponse(): Response
    {
        try {
           $reponse = new Response(isHtmlContent: true);
           $reponse->setFilePath(__DIR__ .'/home-page.php');
           return $reponse;
        } catch (\Exception $e) {
            Utils::log_error($e->getMessage());
            return new Response(
                ResponseStatus::INTERNAL_SERVER_ERROR, 
                ResponseStatus::HTTP_INTERNAL_SERVER_ERROR, 
                false, 
                "Internal Server Error"
            );
        }
    }
    
}