<?php
    /**
     * @param $error_message the error messages to log on error.log file
     */
    function log_error($error_message){
        error_log($error_message.PHP_EOL.PHP_EOL, 3, $_SERVER['DOCUMENT_ROOT']."/error/error.log");
    }
?>