<?php
namespace ToDo;

class ResponseStatus
{
    public const OK = 'OK';
    public const FAILED = 'FAILED';
    public const CREATED = 'CREATED';
    public const UPDATED = 'UPDATED';
    public const DELETED = 'DELETED';
    public const NOT_FOUND = 'NOT_FOUND';
    public const ACCEPTED = 'ACCEPTED';
    public const UNAUTHORIZED = 'UNAUTHORIZED';
    public const FORBIDDEN = 'FORBIDDEN';
    public const ERROR = 'ERROR';
    public const INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
}

/*Data Type*/
define('BOOLEAN', 	'1');
define('INTEGER', 	'2');
define('STRING', 	'3');

/*Error Codes*/
define('UNAUTHORIZED_ACCESS',					401);
define('REQUEST_METHOD_NOT_VALID',		        100);
define('REQUEST_CONTENT_NOT_VALID',	        	101);
define('REQUEST_NOT_VALID', 			        102);
define('VALIDATE_PARAMETER_REQUIRED', 			103);
define('VALIDATE_PARAMETER_DATATYPE', 			104);
define('API_NAME_REQUIRED', 					105);
define('API_PARAM_REQUIRED', 					106);
define('API_DOST_NOT_EXIST', 					107);
define('INVALID_USER_PASS', 					108);
define('USER_NOT_ACTIVE', 						109);

define('SUCCESS_RESPONSE', 						200);

/*Server Errors*/
define('INTERNAL_SERVER_ERROR', 500);

define('JWT_PROCESSING_ERROR',					300);
define('ATHORIZATION_HEADER_NOT_FOUND',			301);
define('ACCESS_TOKEN_ERRORS',					302);	
