<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }
    public function hasChildren(){
        return count($this->children);
    }

}
