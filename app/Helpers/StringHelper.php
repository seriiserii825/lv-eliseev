<?php

namespace App\Helpers;

class StringHelper
{
    public static function toJson($str)
    {
        return json_encode(array_map('trim', preg_split('#[\r\n]+#', $str)));
    }

    public static function fromJson($array)
    {
        $variants_str = implode(PHP_EOL, $array);
        return trim(html_entity_decode($variants_str));
    }
}
