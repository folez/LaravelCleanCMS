<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string slug
 * @property string title
 * @property string name
 * @property string description
 * @property string keywords
 * @property string body
 * @property int page_id
 * @property int language_id
 */
class Page extends Model
{
    use Translatable;

    protected string $translationFkName = 'page_id';
    protected string $translationTableName = PageTranslation::TABLE_NAME;
    protected string $translationModelClass = PageTranslation::class;

    public const TABLE_NAME = "page";
    protected $table = self::TABLE_NAME;
}
