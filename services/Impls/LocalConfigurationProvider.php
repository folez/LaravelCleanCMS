<?php


namespace Services\Impls;


use Models\Configuration;
use Services\Contracts\LoggerServiceBase;

class LocalConfigurationProvider implements \Services\Contracts\IConfigurationService
{
    private $configurationPath;
	public function __construct( string $configurationPath)
	{
        $this->configurationPath    = $configurationPath;
	}

	/**
	 * @inheritDoc
	 */
	public function Get()
	{
	    $objectToReturn = json_decode( file_get_contents($this->configurationPath));
        if($objectToReturn) {
            return $objectToReturn;
        }
        $configuration = Configuration::Default();
        $this->Set($configuration);
        return $configuration;
	}

	/**
	 * @inheritDoc
	 */
	public function Set( Configuration $configuration ): void
	{
		$dataEncoded = json_encode( $configuration, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_FORCE_OBJECT );
		$handle = fopen($this->configurationPath, 'w+');
		fwrite($handle, $dataEncoded);
	}
}
