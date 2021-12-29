<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::query()->where('parent_id', null)->orderBy('name')->paginate(10);
        return view('admin.regions.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.regions.create');
    }

    public function store(Request $request)
    {

        return redirect()->route('admin.regions.index')->with('success', 'Region was created');
    }

    public function show(Region $region)
    {
        $regions = Region::query()->where('parent_id', $region->id)->get();
        return view('admin.regions.show', compact('region', 'regions'));
    }

    public function edit(Region $region)
    {
        return view('admin.regions.edit', compact('region'));
    }

    public function update(UpdateRequest $request, Region $region)
    {
        $region->update($request->only(['name', 'slug', 'parent_id']));

        return redirect()->route('admin.regions.index')->with('success', 'Region was updated');
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.regions.index')->with('success', 'Region was deleted');
    }
}
