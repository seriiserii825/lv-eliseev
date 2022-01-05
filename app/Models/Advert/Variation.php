<?php

namespace App\Models\Advert;

use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    protected $table = 'advert_variations';
    protected $fillable = ['name', 'slug', 'sort'];
    protected $guarded = ['id'];
    public $timestamps = false;
}
