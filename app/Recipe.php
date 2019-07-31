<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Recipe
 * @package App
 *
 * @property string thumbnail
 * @property int id
 * @property string title
 * @property string description
 * @property string thumbnail_download
 */
class Recipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $appends = ['thumbnail_download'];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(RecipeCategory::class, 'recipe_category_id');
    }

    public function getThumbnailDownloadAttribute()
    {
        return $this->thumbnail;
    }
}
