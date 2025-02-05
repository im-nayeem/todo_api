<?php
namespace ToDo;

use ToDo\Models\Response;

abstract class AbstractExecutor
{
    public function __construct()
    {
        
    }
    protected abstract function getResponse(): Response;

    public function execute(): Response
    {
        return $this->getResponse();
    }
}