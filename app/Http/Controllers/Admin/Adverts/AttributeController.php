<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Models\Adverts\Attribute;
use App\Models\AdvertsCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttributeController extends Controller
{
    public function index()
    {
    }

    public function create(Request $request)
    {
        $types = Attribute::typesList();
        $category = AdvertsCategory::findOrFail($request->get('category_id'));
        return view('admin.adverts.attributes.create', compact('category', 'types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typesList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort' => 'required|integer',
        ]);
        $category_id = $request->get('category_id');
        $attribute = Attribute::create([
            'name' => $request['name'],
            'type' => $request['type'],
            'category_id' => $request->get('category_id'),
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort']
        ]);
        return redirect()->route('admin.adverts_attributes.show', [$attribute, 'category' => AdvertsCategory::findOrFail($category_id)]);
    }

    public function show($id, Request $request)
    {
        $category = AdvertsCategory::findOrFail($request->get('category'));
        $attribute = Attribute::findOrFail($id);
        return view('admin.adverts.attributes.show', compact('attribute', 'category'));
    }

    public function edit($id, Request $request)
    {
        $types = Attribute::typesList();
        $category = AdvertsCategory::findOrFail($request->get('category'));
        $attribute = Attribute::findOrFail($id);
        return view('admin.adverts.attributes.edit', compact('attribute', 'category', 'types'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'type' => ['required', 'string', 'max:255', Rule::in(array_keys(Attribute::typesList()))],
            'required' => 'nullable|string|max:255',
            'variants' => 'nullable|string',
            'sort' => 'required|integer',
        ]);
        $attribute = Attribute::findOrFail($id);
        $attribute->update([
            'name' => $request['name'],
            'type' => $request['type'],
            'required' => (bool)$request['required'],
            'variants' => array_map('trim', preg_split('#[\r\n]+#', $request['variants'])),
            'sort' => $request['sort']
        ]);
        return redirect()->route('admin.adverts_attributes.show', [$attribute, 'category' => AdvertsCategory::findOrFail($attribute->category_id)]);
    }

    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();
        return view('admin.index');
    }
}
