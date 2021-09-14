<?php


namespace Services\Impls;


use Services\Contracts\LoggerServiceBase;

class FileLogger extends LoggerServiceBase
{



    /**
     * @var string
     */
    private $fileLogPath;

	/**
	 * @inheritDoc
	 */
	public function __construct(  $configuration, string $fileLogPath)
	{
	    parent::__construct($configuration);

	    $this->fileLogPath = $fileLogPath;
	}

    private function openLogFile()
    {
        return fopen($this->fileLogPath, 'a+');
	}

	/**
	 * @inheritDoc
	 */
	public function Log( string $text, array $trace, $type ): void
	{
	    if(!$this->configuration->{"log".ucfirst($type)}) return;

        $handle = $this->openLogFile();

        fwrite($handle, $this->Format($text, $trace, strtoupper($type)) );
	}
}
