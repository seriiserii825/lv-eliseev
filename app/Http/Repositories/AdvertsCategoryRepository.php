<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\AdvertsCategoryRepositoryInterface;
use App\Models\AdvertsCategory;

class AdvertsCategoryRepository implements AdvertsCategoryRepositoryInterface
{
    public function getAll()
    {
        $fillableColumns = AdvertsCategory::getFillableColumns();
        return AdvertsCategory::query()
            ->select($fillableColumns)
            ->get();
    }

    public function getOne($id)
    {
        return AdvertsCategory::query()->findOrFail($id);
    }
}
