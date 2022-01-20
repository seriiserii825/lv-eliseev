<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\AdvertsCategory;

interface AdvertsCategoryRepositoryInterface
{
    public function getAll();

    public function getOne(AdvertsCategory $advertsCategory);
}
