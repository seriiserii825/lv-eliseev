<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property defaultOrder
 * @property withDepth
 */
class AdvertsCategory extends Model
{
    use NodeTrait;
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function attributes()
    {
        return $this->hasMany(AdvertAttributes::class, 'advert_category_id', 'id');
    }
}
