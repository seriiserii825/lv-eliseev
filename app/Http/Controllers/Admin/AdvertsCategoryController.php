<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertsCategoryController extends Controller
{
    public function index()
    {
        $categories = AdvertsCategory::query()->defaultOrder()->withDepth()->get();
        return view('admin.adverts_categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = AdvertsCategory::query()->defaultOrder()->withDepth()->get();
        return view('admin.adverts_categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:adverts_categories,id'
        ]);
        try {
            AdvertsCategory::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'parent_id' => $request->parent_id
            ]);
        } catch (\DomainException $e) {
            return redirect()->route('admin.adverts_categories.index')->with('error', $e->getMessage());
        }
        return redirect()->route('admin.adverts_categories.index')->with('success', 'Adverts category was created');
    }

    public function show(AdvertsCategory $advertsCategory)
    {
        return view('admin.adverts_categories.show', compact('advertsCategory'));
    }

    public function edit(AdvertsCategory $advertsCategory)
    {
        $parents = AdvertsCategory::query()->defaultOrder()->withDepth()->get();
        return view('admin.adverts_categories.edit', compact('advertsCategory', 'parents'));
    }

    public function update(Request $request, AdvertsCategory $advertsCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:adverts_categories,id'
        ]);

        $advertsCategory->update($request->only(['name', 'slug', 'parent_id']));
        return redirect()->route('admin.adverts_categories.index')->with('success', 'Adverts category was updated');
    }

    public function destroy(AdvertsCategory $advertsCategory)
    {
        $advertsCategory->delete();
        return redirect()->route('admin.adverts_categories.index')->with('success', 'Adverts category was updated');
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
