<?php


namespace Services\Impls;


use Models\LoggerConfiguration;
use Services\Contracts\enum;
use Services\Contracts\LoggerServiceBase;
use App\Models\DbLog;

class DbLogger extends LoggerServiceBase
{

    public function Log( string $text, array $trace, $type ): void
    {
        if(!$this->configuration->{"log".ucfirst($type)}) return;

        $logger = new DbLog();
        $logger->message = $text;
        $logger->trace = json_encode($trace, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        $logger->type = strtolower($type);
        $logger->visitor = app('request')->ip();
        $logger->save();
    }
}
