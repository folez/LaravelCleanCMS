<?php

namespace App\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method languageCode
 * @property Translatable languageCode
 */
trait Translatable
{
    /**
     * @param Builder $builder
     * @param string  $code
     * @return Builder
     */
    public function scopeLanguageCode( Builder $builder ) : Collection
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

        return $builder
            ->join($this->translationTableName.' as translation',
                $this->table.'.id',
                '=',
                'translation'.'.'.$this->translationFkName)
            ->where('translation'.'.language_id','=',function (\Illuminate\Database\Query\Builder $builder) use ($code){
                $builder->from(Language::TABLE_NAME)->select('id')->where('code','=',$code);
            })->get();
    }
}
