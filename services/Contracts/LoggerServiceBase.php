<?php


namespace Services\Contracts;


use App\Models\DbLog;

abstract class LoggerServiceBase
{
    protected $configuration;
    public function __construct( $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param string $text
     * @param array  $trace
     */
    public function Debug( string $text, array $trace ): void
    {
        $this->Log($text, $trace, 'debug');
    }

    /**
     * @param string $text
     * @param array  $trace
     */
    public function Info( string $text, array $trace ): void
    {
        $this->Log($text, $trace, 'info');
    }

    /**
     * @param string $text
     * @param array  $trace
     */
    public function Warning( string $text, array $trace ): void
    {
        $this->Log($text, $trace, 'warning');
    }

    /**
     * @param string $text
     * @param array  $trace
     */
    public function Error( string $text, array $trace ): void
    {
        $this->Log($text, $trace, 'error');
    }

    /**
     * @param string $text
     * @param array  $trace
     */
    public function Critical( string $text, array $trace ): void
    {
        $this->Log($text, $trace, 'critical');
    }

	/**
	 * @param array $phones
	 * @param       $text
	 * @param array $trace
	 * @param       $type
	 */
	public function MultipleNotifyLog( array $phones, $text, array $trace, $type ): void
	{
		foreach ($phones as $phone){
			if(!$this->configuration->{"log".ucfirst($type)}) return;

			$logger = new DbLog();
			$logger->message = sprintf($text, $phone);
			$logger->trace = json_encode($trace, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
			$logger->type = strtolower($type);
			$logger->visitor = app('request')->ip();
			$logger->save();
		}
	}


    /**
     * @param string $text
     * @param enum type $type
     * @description Can be Debug, Info, Error, Critical
     */
    public abstract function Log( string $text, array $trace, $type ) : void;


    /**
     * @param $text
     * @param $trace debug_backtrace()
     * @param enum type $type
     * @description Can be Debug, Info, Error, Critical
     * @return string
     */
    protected function Format( string $text, array $trace, $type ): string
    {
        $logDate = date('d.m.Y H:i:s');

//        $objectTrace = $trace[0];
//        $objectTrace['args'] = $trace[1]['args'];
        $formatedTrace = json_encode($trace, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

        $formatedText  = "[{$logDate}] {$type} {$text}  STACK TRACE : {$formatedTrace} \r\n";

        return $formatedText;
    }
}
