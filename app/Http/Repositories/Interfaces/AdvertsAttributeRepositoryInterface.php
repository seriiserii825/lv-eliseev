<?php

namespace App\Http\Repositories\Interfaces;

use App\Models\Adverts\Attribute;

interface AdvertsAttributeRepositoryInterface
{
    public function getAll();
    public function getOne(Attribute $attribute);
}
