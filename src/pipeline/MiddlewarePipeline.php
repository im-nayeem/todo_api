<?php
namespace ToDo\Pipeline;

use ToDo\Utils\Utils;

class MiddlewarePipeline
{
    private static $instance = null;
    private $middlewares = [];

    private function __construct()
    {
        Utils::log_info('MiddleWare Pipleline Instance Created.');
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function add($middleware)
    {
        if (!in_array($middleware, $this->middlewares, true)) {
            $this->middlewares[] = $middleware;
        }
    }

    public function handle($next)
    {
        foreach (array_reverse($this->middlewares) as $middleware) {
            $next = function () use ($middleware, $next) {
                return $middleware->handle($next);
            };
        }
        return $next();
    }

    private function __clone()
    {
    }

    public function __destruct()
    {
        Utils::log_info('Middleware Pipeline Instance Destroyed.');
    }
}
