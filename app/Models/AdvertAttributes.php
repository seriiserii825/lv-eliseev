<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertAttributes extends Model
{
    public const TYPE_STRING = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT = 'float';

    protected $fillable = ['name', 'type', 'required', 'variants', 'sort'];

    protected $casts = [
        'variants' => 'array'
    ];

    public static function typesList(): array
    {
        return [
            self::TYPE_STRING => 'String',
            self::TYPE_FLOAT => 'Float',
            self::TYPE_INTEGER => 'Integer'
        ];
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }
}
