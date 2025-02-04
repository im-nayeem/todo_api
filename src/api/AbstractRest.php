<?php
namespace ToDo\Api;

use ToDo\AbstractExecutor;

abstract class AbstractRest extends AbstractExecutor
{
    public function __construct()
    {
        
    }
    protected abstract function getResponse();
}