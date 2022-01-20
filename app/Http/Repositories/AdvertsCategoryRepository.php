<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Interfaces\AdvertsCategoryRepositoryInterface;
use App\Models\AdvertsCategory;

class AdvertsCategoryRepository implements AdvertsCategoryRepositoryInterface
{
    public function getAll()
    {
        $fillableColumns = AdvertsCategory::FILLABLECOLUMNS;
        return AdvertsCategory::query()
            ->select($fillableColumns)
            ->get();
    }

    public function getAllWithAttributes()
    {
        $fillableColumns = AdvertsCategory::FILLABLECOLUMNS;
        return AdvertsCategory::query()
            ->withDepth()
            ->with('attributes')
            ->select($fillableColumns)
            ->get();
    }

    public function getAllWithDepth()
    {
        $fillableColumns = AdvertsCategory::FILLABLECOLUMNS;
        return AdvertsCategory::query()
            ->defaultOrder()
            ->withDepth()
            ->select($fillableColumns)
            ->get();
    }

    public function getOne($id)
    {
        return AdvertsCategory::query()->findOrFail($id);
    }
}
