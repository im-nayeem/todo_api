<?php
namespace ToDo\Api\Auth;

use ToDo\Api\AbstractRest;
use ToDo\Helper\Auth\AuthenticationHelper;
use ToDo\Utils\Utils;

class RefreshAccessToken extends AbstractRest
{
    public function __construct()
    {
        Utils::log_info('RefreshAccessToken Instance Created.');
    }
    private function refreshAccessToken()
    {
        $accessToken = AuthenticationHelper::refreshAccessToken();
        return $accessToken;
    } 

    public function getResponse()
    {
        return self::refreshAccessToken();
    }

    public function __destruct() {
        Utils::log_info('RefreshAccessToken Instance Destroyed.');
    }
}

