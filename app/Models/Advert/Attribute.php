<?php

namespace App\Models\Advert;

use App\Models\AdvertsCategory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'variants'];

    public function categories()
    {
        return $this->hasMany(AdvertsCategory::class, 'attribute_id', 'id');
    }
}
