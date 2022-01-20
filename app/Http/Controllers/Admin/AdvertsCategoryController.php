<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StringHelper;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AdvertsCategoryRepository;
use App\Http\Requests\Adverts\AdvertsCategoryCreateRequest;
use App\Http\Requests\Adverts\AdvertsCategoryUpdateRequest;
use App\Models\Advert\Attribute;
use App\Models\AdvertsCategory;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertsCategoryController extends Controller
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = app(AdvertsCategoryRepository::class);
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllWithAttributes();
        return view('admin.adverts_categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = $this->categoryRepository->getAllWithDepth();
        return view('admin.adverts_categories.create', compact('parents'));
    }

    public function store(AdvertsCategoryCreateRequest $request)
    {
        try {
            $advertsCategory = AdvertsCategory::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'parent_id' => $request->parent_id
            ]);
            $catName = $advertsCategory->name;
            $categories = $this->categoryRepository->getAllWithDepth();
            return redirect()->route('admin.adverts_categories.index', compact('categories'))->with('success', "Adverts category ${catName} was created");
        } catch (\DomainException $e) {
            return redirect()->route('admin.adverts_categories.index')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $advertsCategory = $this->categoryRepository->getOne($id);
        $attributes = $advertsCategory->attributes()->orderBy('sort')->get();
        return view('admin.adverts_categories.show', compact('advertsCategory', 'attributes'));
    }

    public function edit($id)
    {
        $advertsCategory = $this->categoryRepository->getOne($id);
        $parents = AdvertsCategory::query()->defaultOrder()->withDepth()->get();
        return view('admin.adverts_categories.edit', compact('advertsCategory', 'parents'));
    }

    public function update(AdvertsCategoryUpdateRequest $request, AdvertsCategory $advertsCategory)
    {
        try {
            $advertsCategory->update($request->only(['name', 'slug', 'parent_id']));
            return redirect()->route('admin.adverts_categories.index')->with('success', 'Adverts category was updated');
        } catch (\LogicException $e) {
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function destroy(AdvertsCategory $advertsCategory)
    {
        $categoryName = $advertsCategory->name;
        $advertsCategory->delete();
        return redirect()->route('admin.adverts_categories.index')->with('success', "Adverts category ${categoryName} was deleted");
    }

    public function first(AdvertsCategory $advertsCategory)
    {
        if ($first = $advertsCategory->siblings()->defaultOrder()->first()) {
            $advertsCategory->insertBeforeNode($first);
            return redirect()->route('admin.adverts_categories.index');
        }
    }

    public function up(AdvertsCategory $advertsCategory)
    {
        $advertsCategory->up();
        return redirect()->route('admin.adverts_categories.index');
    }

    public function down(AdvertsCategory $advertsCategory)
    {
        $advertsCategory->down();
        return redirect()->route('admin.adverts_categories.index');
    }

    public function last(AdvertsCategory $advertsCategory)
    {
        if ($last = $advertsCategory->siblings()->defaultOrder('desc')->first()) {
            $advertsCategory->insertAfterNode($last);
            return redirect()->route('admin.adverts_categories.index');
        }
    }

}
