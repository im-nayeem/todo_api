<?php
namespace ToDo\Utils;

if(!isset($_SESSION))
    session_start();

class Utils
{
    public static function encrypt($data)
    {
        
    }   
    public static function decrypt($encryptedText)
    {

    }

    public static function log_error($error)
    {
        $currentDateTime = self::get_current_date_time();
        error_log($error.PHP_EOL.$currentDateTime.PHP_EOL.PHP_EOL, 3, "Log/error.log");
    }

    public static function log_info($message)
    {
        $currentDateTime = self::get_current_date_time();
        error_log($message.PHP_EOL.$currentDateTime.PHP_EOL.PHP_EOL, 3, "Log/info.log");
    }

    private static function get_current_date_time()
    {
        date_default_timezone_set('Asia/Dhaka');
        $currentDateTime = date('Y-m-d H:i:s');
        return $currentDateTime;
    }

}