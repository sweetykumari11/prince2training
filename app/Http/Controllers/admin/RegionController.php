<?php

namespace App\Http\Controllers\admin;


use App\Models\Region;
use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\RegionUpdateRequest;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Region::with(['creator', 'country']);
            return Datatables::eloquent($query)->make(true);
        }
        return view('admin.region.list');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.region.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionRequest $request): RedirectResponse
    {
        Region::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'created_by' => Auth::user()->id
        ]);
        session()->flash('success', 'Region created successfully.');
        return redirect()->route('region.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region): View
    {
        $countries = Country::all();
        return view('admin.region.edit', compact('region', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionUpdateRequest $request, Region $region): RedirectResponse
    {
        $region->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
        ]);
        session()->flash('success', 'Region updated successfully.');
        return redirect()->route('region.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region): RedirectResponse
    {
        $region->delete();
        session()->flash('danger', 'Region deleted successfully.');
        return redirect()->route('region.index');
    }
}
