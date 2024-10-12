<?php 
namespace ToDo\Middleware;

use ToDo\Middleware\Interface\MiddlewareInterface;

class UriHandlingMiddleware implements MiddlewareInterface {
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
        return $next();
    }

    private function __clone()
    {
    }
}