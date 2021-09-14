<?php


namespace Services\Impls;

use Illuminate\Support\Collection;
use Services\Contracts\enum;

class CompositeLogger extends \Services\Contracts\LoggerServiceBase
{

    private $loggers;
    public function __construct( $configuration, Collection $loggers)
    {
        parent::__construct($configuration->get()->DbConfiguration);
        $this->loggers = $loggers;
    }

	/**
	 * @inheritDoc
	 */
	public function Log( string $text, array $trace, $type ): void
	{
        foreach ($this->loggers as $logger) {
            $logger->Log($text,$trace,$type);
        }
	}
}
