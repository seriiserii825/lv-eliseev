<?php

namespace App\Http\Repositories;

use App\Models\Adverts\Attribute;

class AdvertsAttributeRepository implements \App\Http\Repositories\Interfaces\AdvertsAttributeRepositoryInterface
{

    public function getAll()
    {
        return Attribute::query()
            ->select(['name', 'type', 'required', 'variants', 'sort', 'category_id'])
            ->get();
    }

    public function getOne($id)
    {
        return Attribute::query()
            ->findOrFail($id);
    }
}
