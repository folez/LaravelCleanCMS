<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string title
 * @property string description
 * @property string keywords
 * @property string ogg_title
 * @property string ogg_description
 * @property string image_url
 * @property string ogg_image
 * @property string model_type
 * @property int model_id
 */
class Seo extends Model
{
    protected $table = 'seo_data';

    protected $fillable = [
        'title',
        'description',
        'keywords',

        'ogg_title',
        'ogg_description',

        'image_url',
        'ogg_image',

        'model_type',
        'model_id',

        'sysname'
    ];
}
