<?php

namespace App\Traits;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;

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
    public function scopeLanguageCode( Builder $builder )
    {
        $code = \App::getLocale();
        return $builder
            ->join($this->translationTableName.' as translation',
                $this->table.'.id',
                '=',
                'translation'.'.'.$this->translationFkName)
            ->where('translation'.'.language_id','=',function (\Illuminate\Database\Query\Builder $builder) use ($code){
                $builder->from(Language::TABLE_NAME)->select('id')->where('code','=',$code);
            });
        return $builder
            ->join($this->translationTableName, "{$this->translationTableName}.id", "{$this->translationTableName}.{$this->translationFkName}" )
            ->where("{$this->translationTableName}.language_id",'=',$id);
    }
}
