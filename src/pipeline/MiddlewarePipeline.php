<?php
namespace ToDo\Pipeline;
class MiddlewarePipeline
{
    protected static $instance = null;
    protected $middlewares = [];

    private function __construct()
    {
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
}
