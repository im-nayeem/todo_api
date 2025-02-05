<?php
namespace ToDo\Api;

use ToDo\AbstractExecutor;
use ToDo\Models\Response;

abstract class AbstractRest extends AbstractExecutor
{
    public function __construct()
    {
        
    }
    protected abstract function getResponse(): Response;
}