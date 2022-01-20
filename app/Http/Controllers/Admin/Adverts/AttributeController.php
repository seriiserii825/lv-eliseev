<?php

namespace App\Http\Controllers\Admin\Adverts;

use App\Http\Controllers\Controller;
use App\Http\Repositories\AdvertsAttributeRepository;
use App\Http\Repositories\AdvertsCategoryRepository;
use App\Http\Requests\AdvertsAttribute\AdvertsAttributeStoreRequest;
use App\Http\Requests\AdvertsAttribute\AdvertsAttributeUpdateRequest;
use App\Models\Adverts\Attribute;
use App\Models\AdvertsCategory;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    private $advertsAttributeRepository;
    private $advertsCategoryRepository;

    public function __construct()
    {
        $this->advertsAttributeRepository = app(AdvertsAttributeRepository::class);
        $this->advertsCategoryRepository = app(AdvertsCategoryRepository::class);
    }

    public function create(Request $request)
    {
        $types = Attribute::typesList();
        $category = $this->advertsCategoryRepository->getOne(($request->get('category_id')));
        return view('admin.adverts.attributes.create', compact('category', 'types'));
    }

    public function store(AdvertsAttributeStoreRequest $request)
    {
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
        $category = $this->advertsCategoryRepository->getOne(($request->get('category')));
        $attribute = $this->advertsAttributeRepository->getOne($id);
        return view('admin.adverts.attributes.show', compact('attribute', 'category'));
    }

    public function edit(Request $request, $id)
    {
        $types = Attribute::typesList();
        $category = $this->advertsCategoryRepository->getOne(($request->get('category_id'))) ;
        $attribute = $this->advertsAttributeRepository->getOne($id);
        return view('admin.adverts.attributes.edit', compact('attribute', 'category', 'types'));
    }

    public function update(AdvertsAttributeUpdateRequest $request, $id)
    {
        $attribute = $this->advertsAttributeRepository->getOne($id);
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
        $attribute = $this->advertsAttributeRepository->getOne($id);
        $attribute->delete();
        return view('admin.index');
    }
}
