<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\AdvertsCategory;
use Faker\Generator as Faker;

$factory->define(AdvertsCategory::class, function (Faker $faker) {
    $name = $faker->unique()->name;
    return [
        'name' => $name,
        'slug' => \Illuminate\Support\Str::slug($name),
        'parent_id' => null
    ];
});
