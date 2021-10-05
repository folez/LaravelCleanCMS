<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Language
 * @package App\Models
 * @property int id
 * @property string code
 * @property string name
 * @property bool is_default
 */
class Language extends Model
{
    /**
     * @var string
     */
    protected $table = 'language';
    public const TABLE_NAME = 'language';


    /**
     * @var string[]
     */
    protected $fillable = [
        'code','name', 'is_default'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    public static function findByCode( string $code )
    {
        return self::where('code', $code)->first();
    }

    public static function getDefaultLanguage()
    {
        return self::where('is_default', 1)->first();
    }
}
