<?php
namespace ToDo;

abstract class AbstractExecutor
{
    public function __construct()
    {
        
    }
    protected abstract function getResponse();

    public function execute()
    {
        return $this->getResponse();
    }
}