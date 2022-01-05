<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\Advert\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertAttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return view('admin.adverts.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('admin.adverts.attributes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'variants' => 'nullable|string'
        ]);

        $variants = StringHelper::toJson($request['variants']);

        try {
            Attribute::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'variants' => json_encode($variants)
            ]);
        } catch (\DomainException $e) {
            return redirect()->route('admin.adverts_attributes.index')->with('error', $e->getMessage());
        }
        return redirect()->route('admin.adverts_attributes.index')->with('success', 'Region was created');
    }

    public function show($id)
    {
        $attribute = Attribute::findOrFail($id);
        return view('admin.adverts.attributes.show', compact('attribute'));
    }

    public function edit($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->variants = StringHelper::fromJson($attribute->variants);
        return view('admin.adverts.attributes.edit', compact('attribute'));
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
