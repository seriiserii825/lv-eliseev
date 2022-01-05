<?php

namespace App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'variants'];
}
