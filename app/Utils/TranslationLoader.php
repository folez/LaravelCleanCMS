<?php

namespace App\Utils;

use App\Models\LanguageWord;
use Illuminate\Translation\FileLoader;
use Illuminate\Support\Facades\Cache;

class TranslationLoader extends FileLoader
{
    public function load( $locale, $group, $namespace = null )
    {
        /*if ($namespace !== null && $namespace !== '*') {
            return $this->loadNamespaced($locale, $group, $namespace);
        }*/
        return  Cache::remember("locale.fragments.{$locale}.{$group}", 60,
            function () use ($locale, $group) {
                return LanguageWord::findWithLocaleIdAndWordName($locale, $group);
            });
    }
}
