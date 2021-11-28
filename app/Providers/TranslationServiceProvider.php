<?php

namespace App\Providers;

use App\Utils\CustomTranslator;
use App\Utils\TranslationLoader;
use Illuminate\Translation\TranslationServiceProvider as ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
	public function register()
    {
        $this->registerLoader();
        $this->app->bind('translator', function ($app) {
            $loader = $app['translation.loader'];
            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration so we can easily get both of these values from there.
            $locale = $app['config']['app.locale'];

            $trans = new CustomTranslator($loader, $locale);

            $trans->setFallback($app['config']['app.fallback_locale']);
            return $trans;
        });
    }

    public function registerLoader()
    {
        //
        $this->app->singleton('translation.loader', function ($app) {
            return new TranslationLoader($app['files'], $app['path.lang']);
        });
    }
}
