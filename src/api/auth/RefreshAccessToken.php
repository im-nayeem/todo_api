<?php
namespace ToDo\Api\Auth;

use ToDo\Api\AbstractRest;
use ToDo\Helper\Auth\AuthenticationHelper;

class RefreshAccessToken extends AbstractRest
{
    private function refreshAccessToken()
    {
        $accessToken = AuthenticationHelper::refreshAccessToken();
        return $accessToken;
    } 

    public function getResponse()
    {
        return self::refreshAccessToken();
    }
}

