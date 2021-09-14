<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Services\Contracts\IConfigurationService;
use Services\Contracts\LoggerServiceBase;
use Services\Impls\CompositeLogger;
use Services\Impls\DbLogger;
use Services\Impls\LocalConfigurationProvider;
use Services\Impls\TelegramLogger;

class LoggerServiceProvider extends ServiceProvider
{
	public function register()
	{
		//
	}

	public function boot()
	{
        /**
         * @description Load Configuration Services
         * */
        $this->app->bind(IConfigurationService::class, function ($app) {
            $config = new LocalConfigurationProvider(storage_path('config.json'));
            return $config;
        });

        /**
         * @description Load Logger Services
         * */
        $this->app->bind(LoggerServiceBase::class, function ($app) {
            $configuration = $app->make(IConfigurationService::class)->Get();
            $loggers = collect([
                new TelegramLogger( $configuration->telegramLogger ),
                new DbLogger( $configuration->DbConfiguration ),
            ]);

            return new CompositeLogger( $app->make(IConfigurationService::class), $loggers);
        });
	}
}
