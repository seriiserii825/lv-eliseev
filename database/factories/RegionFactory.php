<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Region;
use Faker\Generator as Faker;

//$array = explode("\n", file_get_contents(__DIR__ . '/test.php'));
//
//foreach ($array as $value) {
//    Region::create([
//        'name' => $value,
//        'slug' => Str::slug($value),
//        'parent_id' => 547
//    ]);
//}


$factory->define(Region::class, function (Faker $faker) {
    $name = $faker->unique()->city();
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'parent_id' => null
    ];
});
