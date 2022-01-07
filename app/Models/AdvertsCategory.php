<?php

namespace App\Models;

use App\Models\Adverts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class AdvertsCategory extends Model
{
    use NodeTrait;
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'adverts_categories_attributes', 'adverts_category_id', 'id');
    }
}
