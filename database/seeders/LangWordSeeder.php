<?php

namespace Database\Seeders;

use App\Models\LanguageWord;
use Illuminate\Database\Seeder;

class LangWordSeeder extends Seeder
{
	public function run()
	{
        $fileLoader = new \Illuminate\Translation\FileLoader(new \Illuminate\Filesystem\Filesystem(), lang_path());
        $filesArray = [
            'auth',
            'pagination',
            'passwords',
            'validation'
        ];
        $langs = [
            2 => 'en',
            1 => 'ru'
        ];
        foreach ($langs as $langID =>  $lang) {
            foreach ($filesArray as $fileName) {
                $wordsKey = $fileLoader->load($lang, $fileName);
                foreach ($wordsKey as $wordKey => $wordCustom) {
                    if(is_array($wordCustom)) {
                        $wordsCustom = $wordCustom;
                        foreach ($wordsCustom as $key => $value){
                            $valueToDb = $value;
                            if(is_array($valueToDb))
                                continue;

                            $keyToDb = "{$wordKey}.{$key}";
                        }
                    } else {
                        $keyToDb = "{$wordKey}";
                        $valueToDb = $wordCustom;
                    }

                    $langWord = new LanguageWord();
                    $langWord->word_custom = $valueToDb;
                    $langWord->word_default = $valueToDb;
                    $langWord->word_key = $keyToDb;
                    $langWord->word_name = $fileName;
                    $langWord->language_id = $langID;
                    $langWord->save();
                }
            }
        }


	}
}
