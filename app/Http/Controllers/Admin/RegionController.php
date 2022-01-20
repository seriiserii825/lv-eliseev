<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adverts\RegionCreateRequest;
use App\Http\Requests\Adverts\RegionUpdateRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Region;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        $regions = Region::query()->where('parent_id', null)->orderBy('name')->paginate(100);
        $regions_village = count(Region::query()->where('parent_id', '<>', null)->get());
        $regions_count = count($regions);
        return view('admin.regions.index', compact('regions', 'regions_count', 'regions_village'));
    }

    public function create()
    {
        $regions = Region::query()->where('parent_id', null)->orderBy('name')->get();
        return view('admin.regions.create', compact('regions'));
    }

    public function store(RegionCreateRequest $request)
    {
        try {
            Region::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'parent_id' => $request->parent_id
            ]);
        } catch (\DomainException $e) {
            return redirect()->route('admin.regions.index')->with('error', $e->getMessage());
        }
        return redirect()->route('admin.regions.index')->with('success', 'Region was created');
    }

    public function show(Region $region)
    {
        $regions = Region::query()->where('parent_id', $region->id)->get();
        return view('admin.regions.show', compact('region', 'regions'));
    }

    public function edit(Region $region)
    {
        $regions = Region::query()->where('parent_id', null)->orderBy('name')->get();
        return view('admin.regions.edit', compact('region', 'regions'));
    }

    public function update(RegionUpdateRequest $request, Region $region)
    {
        try {
            $region->update($request->only(['name', 'slug', 'parent_id']));
            return redirect()->route('admin.regions.index')->with('success', 'Region was updated');
        } catch (QueryException $e) {
            return back()->withErrors(['msg' => $e->getMessage()]);
        }
    }

    public function destroy(Region $region)
    {
        $region->delete();
        return redirect()->route('admin.regions.index')->with('success', 'Region was deleted');
    }
}
