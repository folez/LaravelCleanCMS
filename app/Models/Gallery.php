<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string filename
 * @property string model_type
 * @property int model_id
 * @property string temp_id
 * @property int priority
 */
class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'filename', 'model_type', 'model_id', 'temp_id', 'priority'
    ];

    public static function findByModelType( string $modelType )
    {
        return self::where('model_type', '=', $modelType)->orderBy('priority','asc')->get();
    }

    public static function findByModelTypeAndTempId( string $modelType, string $tempId )
    {
        return self::where('model_type', '=', $modelType)->where('temp_id', '=', $tempId)->orderBy('priority','asc')->get();
    }

    public static function findByModelTypeAndModelId( string $modelType, string $modelId )
    {
        return self::where('model_type', '=', $modelType)->where('model_id', '=', $modelId)->orderBy('priority','asc')->get();
    }
}
