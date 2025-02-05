<?php
namespace ToDo\Api\Auth;

use Override;
use ToDo\Api\AbstractRest;
use ToDo\Models\Response;
use ToDo\Service\AuthenticationService;
use ToDo\Utils\Utils;

class RefreshAccessToken extends AbstractRest
{
    private ?AuthenticationService $authService = null;
    public function __construct()
    {
        $this->authService = AuthenticationService::getInstance();
        Utils::log_info('RefreshAccessToken Instance Created.');
    }
    private function refreshAccessToken()
    {
        $accessToken = $this->authService->refreshAccessToken();
        return $accessToken;
    } 

    protected function getResponse(): Response
    {
        $response = self::refreshAccessToken();
        return new Response(data: $response);
    }

    public function __destruct() {
        Utils::log_info('RefreshAccessToken Instance Destroyed.');
    }
}

