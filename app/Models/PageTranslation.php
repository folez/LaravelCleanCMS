<?php

namespace App\Models;

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
    public const TABLE_NAME = "page_translation";
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'title', 'name', 'description', 'keywords', 'body', 'page_id', 'language_id'
    ];

    protected $primaryKey = 'p_id';

    public array $mapFillable = [
        'name' => [
            'type'  => 'input',
            'rule'  => 'string',
            'name'  => 'Название'
        ],

        'title' => [
            'type'  => 'input',
            'rule'  => 'string',
            'name'  => 'Заголовок'
        ],
        'keywords' => [
            'type'  => 'input',
            'rule'  => 'string',
            'name'  => 'Ключевые слова'
        ],
        'description' => [
            'type'  => 'input',
            'rule'  => 'string',
            'name'  => 'Мета описание'
        ],
        'body' => [
            'type'  => 'editor',
            'rule'  => 'string',
            'name'  => 'Описание'
        ],
    ];
}
