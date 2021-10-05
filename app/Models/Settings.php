<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string setting_name
 * @property string setting_key
 * @property string setting_type
 * @property string setting_value
 */
class Settings extends Model
{
    protected $table = 'setting';

    protected $fillable = [
        'setting_name',
        'setting_key',
        'setting_type',
        'setting_value',
    ];

    public static function getByNameAndKey( string $settingName, string $settingKey )
    {
        return self::where('setting_name', '=', $settingName)->where('setting_key','=', $settingKey)->first()?->setting_value;
    }

    public static function setValueByNameAndKey( string $settingName, string|null $settingValue ) : void
    {
        $settingArray = explode('.', $settingName);
        $setting = self::where('setting_name', '=', $settingArray[0])->where('setting_key', '=', $settingArray[1])->first();

        $setting->setting_value = $settingValue;
        $setting->save();
    }
}
