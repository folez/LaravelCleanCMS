<?php


namespace Models;


class LoggerConfiguration
{
    /**
     * @var bool
     */
    public $logCritical = true;

    /**
     * @var bool
     */
    public $logDebug = false;

    /**
     * @var bool
     */
    public $logInfo = false;

    /**
     * @var bool
     */
    public $logWarning = false;

    /**
     * @var bool
     */
    public $logError = true;


    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call( $name, $arguments )
    {
        return $this->$name;
    }
}
