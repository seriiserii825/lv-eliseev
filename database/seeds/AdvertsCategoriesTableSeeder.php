<?php

use App\Models\AdvertsCategory;
use Illuminate\Database\Seeder;

class AdvertsCategoriesTableSeeder extends Seeder
{
    public function run()
    {
        factory(AdvertsCategory::class, 10)->create()->each(function (AdvertsCategory $advertsCategory) {
            $counts = [0, random_int(1, 3)];
            $advertsCategory->children()->saveMany(factory(AdvertsCategory::class, $counts[array_rand($counts)])->create()->each(function (AdvertsCategory $advertsCategory) {
                $counts = [0, random_int(1, 3)];
                $advertsCategory->children()->saveMany(factory(AdvertsCategory::class, $counts[array_rand($counts)])->create());
            }));
        });
    }
}
