<?php
namespace ToDo\Middleware;

require_once 'vendor/autoload.php';

use ToDo\Helper\Auth\AuthenticationHelper;
use ToDo\Helper\ResponseHelper;
use ToDo\Middleware\Interface\MiddlewareInterface;
use ToDo\ResponseStatus;

class AuthMiddleware implements MiddlewareInterface
{
    protected static $instance = null;
    private function __construct() {
    }
    public static function getInstance() 
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function handle($next)
    {
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $bypassPaths = [
            '/api/auth/refresh-access-token',
            '/api/auth/login',
            '/api/auth/signup',
            '/api/auth/reset-password'  
        ];
        if (in_array($currentPath, $bypassPaths)) {
            return $next();
        }
        $hasValidAccessToken = AuthenticationHelper::hasValidAccessToken();
        if(!$hasValidAccessToken) {
            $response = 'Invalid access token!';
            ResponseHelper::generateResponse(ResponseStatus::UNAUTHORIZED, UNAUTHORIZED_ACCESS, $response);
            exit;
        }

        return $next();
    }

    private function __clone()
    {
    }
}
?>
