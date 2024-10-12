<?php
namespace ToDo\Api;

abstract class AbstractRest
{
    public function __construct()
    {
        
    }
    public abstract function getResponse();
}