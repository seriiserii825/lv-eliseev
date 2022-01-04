<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertAttributes;
use App\Models\AdvertsCategory;
use Illuminate\Http\Request;

class AdvertAttributeController extends Controller
{
    public function index()
    {
        //
    }

    public function create(AdvertsCategory $advertsCategory)
    {
        $types = AdvertAttributes::typesList();
        return view('admin.adverts_attributes.create', compact('advertsCategory', 'types'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
