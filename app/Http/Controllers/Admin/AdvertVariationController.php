<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advert\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdvertVariationController extends Controller
{
    public function index()
    {
        $variations = Variation::query()->orderBy('sort')->paginate(20);
        return view('admin.adverts.variations.index', compact('variations'));
    }

    public function create()
    {
        return view('admin.adverts.variations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required|integer|max:255'
        ]);
        try {
            Variation::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'sort' => $request->sort
            ]);
        } catch (\DomainException $e) {
            return redirect()->route('admin.advert_variations.index')->with('error', $e->getMessage());
        }
        return redirect()->route('admin.advert_variations.index')->with('success', 'Variation was created');
    }

    public function show($id)
    {
        $variation = Variation::query()->findOrFail($id);
        return view('admin.adverts.variations.show', compact('variation'));
    }

    public function edit($id)
    {
        $variation = Variation::query()->findOrFail($id);
        return view('admin.adverts.variations.edit', compact('variation'));
    }

    public function update(Request $request, Variation $variation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort' => 'required|integer|max:255'
        ]);

        $variation->update($request->only(['name', 'slug', 'sort']));

        $variations = Variation::query()->orderBy('sort')->paginate(20);
        return view('admin.adverts.variations.index', compact('variations'));
    }

    public function destroy(Variation $variation)
    {
        $variation->delete();

        $variations = Variation::query()->orderBy('sort')->paginate(20);
        return view('admin.adverts.variations.index', compact('variations'));
    }
}
