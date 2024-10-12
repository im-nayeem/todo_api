<?php
namespace ToDo\Middleware;

use ToDo\Utils\Utils;
use ToDo\Middleware\Interface\MiddlewareInterface;

class LogMiddleware implements MiddlewareInterface
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
        Utils::log_info(
            "Request: " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'].PHP_EOL.
            "Remote Address: ".$_SERVER['REMOTE_ADDR']
        );
        return $next();
    }

    private function __clone()
    {
    }

}
?>
