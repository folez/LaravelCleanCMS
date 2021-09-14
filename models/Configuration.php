<?php


namespace Models;


class Configuration
{
    /**
     * @var LoggerConfiguration
     */
    public $loggerConfiguration;

    public $telegramLogger;

    /**
     * @return Configuration
     * @description Return default configuration settings
     */
    public static function Default():Configuration
    {
        $configuration = new Configuration();
        $configuration->DbConfiguration = new LoggerConfiguration();
        $configuration->telegramLogger = new LoggerConfiguration();
        return $configuration;
    }
}
