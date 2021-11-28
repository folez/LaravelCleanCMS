<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int word_id
 * @property int language_id
 * @property string word_name
 * @property string word_key
 * @property string word_default
 * @property string word_custom
 */
class LanguageWord extends Model
{
    /**
     * @var string
     */
    protected $table = 'language_word';
    public const TABLE_NAME = 'language_word';

    public $timestamps = false;

    protected $primaryKey = 'word_id';

    public static function findByNameAndKeyWord( string $wordName,  string $wordKey ): ?string
    {
        $code = self::getLanguageCode();
        $currentLanguageId = Language::findByCode($code)->id;
//        dump($wordName,$wordKey);
        $dbWord = self::where('word_name', $wordName)->where('word_key', $wordKey)->where('language_id', $currentLanguageId)->first();
        if(!$dbWord)
            return "{$wordName}.{$wordKey}";
        return $dbWord->word_custom != null ? $dbWord->word_custom : $dbWord->word_default;
    }

    public static function findWithLocaleIdAndWordName( string $localCode, string $wordName )
    {
        $words = null;
        $language = Language::findByCode($localCode);
        $dbWords = self::where('word_name', $wordName)->where('language_id', $language->id)->get();
        $dbWords->map(function ($item) use ($wordName,&$words,$language) {
            $words['*'][$language->code][$wordName][$item['word_key']] = $item['word_custom'] != null ? $item['word_custom'] : $item['word_default'];
        });
        return $words;
    }

    public static function getAllByLanguageId( int $languageId ): Builder
    {
        return self::where('language_id', $languageId);
    }

    private static function getLanguageCode()
    {
        $code = app()->getLocale();

        foreach (Language::where('is_default', '=',false)->get() as $lang){
            if(\Request::segment(1) == "{$lang->code}"){
                if(session()->get('locale')){
                    $locale = session()->get('locale') ?? $lang->code;
                    app()->setLocale($locale);
                    $code = $locale;
                } else {
                    app()->setLocale($lang->code);
                    $code = $lang->code;
                }
                //                app()->setLocale($lang->code);
            }
        }
        return $code;
    }
}
