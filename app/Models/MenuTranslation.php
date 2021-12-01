<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property int language_id
 * @property int menu_id
 */
class MenuTranslation extends Model
{
    public const TABLE_NAME = "menu_translation";
    protected $table = self::TABLE_NAME;
    public $timestamps = false;

    public $incrementing = false;
    protected $primaryKey = 't_id';

    protected $fillable = ['name'];

    public array $mapFillable = [
        'name' => [
            'type'  => 'input',
            'rule'  => 'string',
            'name'  => 'Название'
        ],
    ];
}
