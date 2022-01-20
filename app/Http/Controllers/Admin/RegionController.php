<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\AdvertsRegionRepository;
use App\Http\Requests\Adverts\RegionCreateRequest;
use App\Http\Requests\Adverts\RegionUpdateRequest;
use App\Models\Region;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class RegionController extends Controller
{
    private $regionRepository;

    public function __construct()
    {
        $this->regionRepository = app(AdvertsRegionRepository::class);
    }

    public function index()
    {
        $regions = $this->regionRepository->getAllParentPaginate();
        $regions_village = $this->regionRepository->countVillage();
        $regions_count = count($regions);
        return view('admin.regions.index', compact('regions', 'regions_count', 'regions_village'));
    }

    public function create()
    {
        $regions = $this->regionRepository->getAllParentPaginate();
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
        $regions = $this->regionRepository->getAllWithSameParent($region->id);
        return view('admin.regions.show', compact('region', 'regions'));
    }

    public function edit(Region $region)
    {
        $regions = $this->regionRepository->getAllParent();
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
