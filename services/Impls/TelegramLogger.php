<?php


namespace Services\Impls;


use Services\Contracts\enum;
use Telegram\Bot\Api;
use Telegram\Bot\FileUpload\InputFile;

class TelegramLogger extends \Services\Contracts\LoggerServiceBase
{

    private $bot;
    public function __construct( $configuration )
    {
        parent::__construct( $configuration );
        $this->bot = new Api('1575547644:AAFmj4c9P451wWsg47mlQD9UIQ3FaDXSgUk');
        $this->loggers = $configuration;
    }

    /**
     * @inheritDoc
     */
    public function Log( string $text, array $trace, $type ): void
    {
        if(!$this->loggers->{"log".ucfirst($type)}) return;
        $data = InputFile::create(\Storage::path('logs/log.txt'), 'stacktrace.txt');
        $this->bot->sendDocument([
            'chat_id'       => '-420932215',
            'document'      => $data,
            'caption'       => "[".url()->current()."] {$type} {$text}",
        ]);
    }
}
