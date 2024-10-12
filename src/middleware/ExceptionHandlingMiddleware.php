<?php
namespace ToDo\Middleware;
use Throwable;
use ToDo\Helper\ResponseHelper;
use ToDo\Middleware\Interface\MiddlewareInterface;
use ToDo\ResponseStatus;
use ToDo\Utils\Utils;

class ExceptionHandlingMiddleware implements MiddlewareInterface
{
    private static $instance = null;
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
        try {
            return $next();
        } catch (Throwable $e) {
            $this->handleException($e);
        }
    }

    protected function handleException(Throwable $e)
    {
        Utils::log_error($e->getMessage());

        ResponseHelper::generateResponse(
            ResponseStatus::INTERNAL_SERVER_ERROR,
            INTERNAL_SERVER_ERROR,
            'An internal server error occurred. Please try again later.'
        ); 
        exit;
    }

    private function __clone()
    {
    }
}

?>
