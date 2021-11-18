<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Searchable
{
    /**
     *
     * Override where used to provide list of columns where to search value
     *
     * @return array
     */
    protected function getDefaultSearchableFields():array
    {
        return [];
    }

    /**
     *
     * Search models that match $search
     *
     * @param Builder        $query
     * @param string         $search searchable value
     * @param array|null     $fields fields where to search
     * @return Builder
     */
    public function scopeRxSearch(
        Builder $query,
        string $search,
        array|null $fields = null) : Builder
    {
        // get fields for searching. use default fields if not specified
        $fields ??= self::getDefaultSearchableFields();
        // validate regex

        $isValidRegex = @preg_match($search, '') !== false;
        if($isValidRegex)
            $isValidRegex = !str_contains($search,'[]');

        if($search == null ||count($fields)<0)
            return $query;

        if($isValidRegex)
            return $query->where(function ($builder) use ($fields,$search) {
                foreach ($fields as $field)
                    // if regex not valid then use like and wrap $search in %...%
                    $builder->orWhere($field,'regexp',$search);
            });
        else
            return $query->search($search,$fields);
    }

    public function scopeSearch(
        Builder $query,
        string $search,
        array|null $fields = null) : Builder
    {
        // get fields for searching. use default fields if not specified
        $fields ??= self::getDefaultSearchableFields();

        if($search == null ||count($fields)<0)
            return $query;

        // if have expression and have fields
        return $query->where(function ($builder) use ($fields,$search) {
            foreach ($fields as $field) {
                if(str_contains($search, '-') && $field == 'code') $search = str_replace('-','',$search);
                $builder->orWhere( $field, 'like', "%{$search}%" );
            }
        });
    }
}
