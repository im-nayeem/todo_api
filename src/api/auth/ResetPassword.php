<?php
namespace ToDo\Api\Auth;

use ToDo\Api\AbstractRest;
use ToDo\Models\Response;

class ResetPassword extends AbstractRest
{
    public function getResponse(): Response
    {
        return new Response(data: "Reset Password");
    }
}