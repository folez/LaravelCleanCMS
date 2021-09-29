<?php

namespace App\Traits;

use App\Models\Seo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

trait SeoTrait
{
    public function seo( Builder $builder, string $modelType, int $modelId ): Collection|Seo
    {
        return Seo::where('model_type', '=', $modelType)->where('model_id', '=', $modelId)->first();
    }
}
