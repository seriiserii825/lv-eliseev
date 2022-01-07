<?php

namespace App\Models\Adverts;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $type
 * @property boolean $required
 * @property array $variants
 * @property integer $sort
 */
class Attribute extends Model
{
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';

    protected $table = 'adverts_attributes';
    protected $fillable = ['name', 'type', 'required', 'variants', 'sort', 'category_id'];

    protected $casts = ['variants' => 'array'];

    public static function typesList()
    {
        return [
            self::TYPE_STRING => 'String',
            self::TYPE_INTEGER => 'Integer',
            self::TYPE_FLOAT => 'Float'
        ];
    }

    public  function is_string(){
        return $this->type === self::TYPE_STRING;
    }

    public  function is_integer(){
        return $this->type === self::TYPE_INTEGER;
    }

    public  function is_float(){
        return $this->type === self::TYPE_FLOAT;
    }

    public  function is_select(){
        return count($this->variants) > 0;
    }
}
