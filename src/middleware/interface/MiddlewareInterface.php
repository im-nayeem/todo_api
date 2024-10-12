<?php
namespace ToDo\Middleware\Interface;
interface MiddlewareInterface
{
    public function handle($next);
}