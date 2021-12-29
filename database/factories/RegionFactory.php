<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
    $name = $faker->unique()->city();
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'parent_id' => null
    ];
});
