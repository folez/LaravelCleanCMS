<?php


namespace Services\Contracts;


use Models\Configuration;

interface IConfigurationService
{

    /**
     * @return Configuration
     */
    public function Get();

    /**
     * @param Configuration $configuration
     * @return void
     */
    public function Set( Configuration $configuration ) : void;
}
