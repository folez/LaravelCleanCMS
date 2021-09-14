<?php


namespace Utils;


class StackTraceExtension
{
    public static function GetStackTrace()
    {
        $trace = debug_backtrace();
        $objectTrace = $trace[0];
        $objectTrace['function'] = $trace[1]['function'];
        $objectTrace['args'] = $trace[1]['args'];
        return $objectTrace;
    }
}
