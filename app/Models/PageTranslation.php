<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string title
 * @property string name
 * @property string description
 * @property string keywords
 * @property string body
 * @property int page_id
 * @property int language_id
 */
class PageTranslation extends Model
{
    use HasCompositePrimaryKey;
    public const TABLE_NAME = "page_translation";
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    protected $fillable = [
        'title', 'name', 'description', 'keywords', 'body', 'page_id', 'language_id'
    ];

    protected $primaryKey = 'p_id';

    public array $mappedFillable = [
        'input'    => [
            'title'         => 'string',
            'name'          => 'string',
            'keywords'      => 'string',
            'description'   => 'string',
        ],
        'textarea'  => [

        ],
        'ckeditor'  => [
            'body'  => 'required'
        ]
    ];
}
