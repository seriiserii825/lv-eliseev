<?php

namespace App\Helpers;

class StringHelper
{
    public static function toJson($str)
    {
        return array_map('trim', preg_split('#[\r\n]+#', $str));
    }

    public static function fromJson($array)
    {
        $variants_array = json_decode($array);
        $variants_str = implode(PHP_EOL, $variants_array);
        return html_entity_decode($variants_str);
    }
}
