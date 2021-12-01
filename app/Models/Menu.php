<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string link
 * @property string type
 * @property int parent_id
 * @property int priority
 * @property Page page
 * @property Collection items
 */
class Menu extends Model
{
    use Translatable;

    protected string $translationFkName = 'menu_id';
    protected string $translationTableName = MenuTranslation::TABLE_NAME;
    protected string $translationModelClass = MenuTranslation::class;

    public const TABLE_NAME = "menu";
    protected $table = self::TABLE_NAME;

    public $timestamps = false;

    public function hasChildren(): int
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id')->count();
    }

    public function items()
    {
        return self::where('parent_id','=',$this->id)->languageCode()->get();
//        return $this->hasMany(Menu::class, 'parent_id', 'id')->languageCode()->get();
    }

    public static function getLastPriority( ?int $parentId = null ): int
    {
        return self::where('parent_id', $parentId)->orderBy('priority','desc')->first()?->priority +1;
    }
}
