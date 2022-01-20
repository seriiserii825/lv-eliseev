<?php

namespace App\Http\Repositories;

use App\Models\Region;

class AdvertsRegionRepository
{
    private $fillableColumns;

    public function __construct()
    {
        $this->fillableColumns = Region::FILLABLE_COLUMNS;
    }

    public function getAll()
    {
        return Region::query()
            ->select($this->fillableColumns)
            ->get();
    }

    public function getAllParent()
    {
        return Region::query()
            ->select($this->fillableColumns)
            ->where('parent_id', null)
            ->orderBy('name')
            ->get();
    }

    public function getAllParentPaginate()
    {
        return Region::query()
            ->select($this->fillableColumns)
            ->where('parent_id', null)
            ->orderBy('name')
            ->paginate(100);
    }

    public function getAllWithSameParent($id)
    {
        return Region::query()
            ->select($this->fillableColumns)
            ->where('parent_id', $id)->get();
    }

    public function countVillage()
    {
        return count(Region::query()->where('parent_id', '<>', null)->get());
    }

    public function getOne($id)
    {
        return Region::query()->select($this->fillableColumns)->findOrFail($id);
    }
}
