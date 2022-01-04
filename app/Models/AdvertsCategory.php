<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class AdvertsCategory extends Model
{
    use NodeTrait;
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'parent_id'];
}
