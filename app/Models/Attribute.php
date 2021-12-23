<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string attribute_name
 * @property string attribute_value
 * @property string temp_id
 * @property string attributes_type
 * @property int attributes_id
 */
class Attribute extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'attribute_name',
        'attribute_value',
        'temp_id',
        'attributes_type',
        'attributes_id',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param string $modelType
     * @return mixed
     */
    public static function findByModelType( string $modelType )
    {
        return self::where('attributes_type', '=', $modelType)->get();
    }

    /**
     * @param string $modelType
     * @param string $tempId
     * @return Collection|null
     */
    public static function findByModelTypeAndTempId( string $modelType, string $tempId ): ?Collection
    {
        return self::where('attributes_type', '=', $modelType)->where('temp_id', '=', $tempId)->get();
    }

    /**
     * @param string $modelType
     * @param string $modelId
     * @return Collection|null
     */
    public static function findByModelTypeAndModelId( string $modelType, string $modelId ): ?Collection
    {
        return self::where('attributes_type', '=', $modelType)->where('attributes_id', '=', $modelId)->get();
    }
}
