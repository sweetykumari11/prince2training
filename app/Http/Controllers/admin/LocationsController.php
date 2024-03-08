<?php

namespace App\Http\Controllers\admin;

use App\Models\Region;
use App\Models\Country;
use App\Models\Location;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\LocationsRequest;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\LocationUpdateRequest;
use App\Http\Requests\LocationsUpdateRequest;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Location::with(['creator', 'region', 'country']);
            return Datatables::eloquent($query)->make(true);
        }
        return view('admin.locations.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $regions = Region::all();
        return view('admin.locations.create', compact('countries', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        $is_popular = $request->is_popular == "on" ? 1 : 0;
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image_location = 'Images/location/';
            $image->move($image_location, $image_name);
            $imagelocation = $image_location . $image_name;
        }
        $location = Location::create([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'region_id' => $request->region_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'intro' => $request->intro,
            'image' => $imagelocation,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_popular' => $is_popular,
            'created_by' => Auth::user()->id,
        ]);

        $location->slugs()->create(['slug' => $request->slug]);
        session()->flash('success', 'Location created successfully.');
        return redirect()->route('locations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $locations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {

        $countries = Country::all();
        $regions = Region::all();
        $slug = $location->slugs()->first();
        return view('admin.locations.edit', compact('slug', 'location', 'countries', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, Location $location)
    {
        $is_popular = $request->is_popular == "on" ? 1 : 0;

        if ($request->file('image')) {
            $imagelocation = 'Images/location/';
            if (!empty($location->image)) {
                unlink(public_path($location->image));
            }
            $image= $request->file('image');
            $imgname = time() . '_' . $image->getClientOriginalName();
            $image->move($imagelocation, $imgname);
            $location->image = $imagelocation . $imgname;
        }
        if ($request['removeLocationImageTxt'] != null) {
            $location->featured_img1 = null;
        }
        $location->update([
            'name' => $request->name,
            'country_id' => $request->country_id,
            'region_id' => $request->region_id,
            'address' => $request->address,
            'phone' => $request->phone,
            'intro' => $request->intro,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_popular' => $is_popular,
        ]);

        $location->slugs()->update(['slug' => $request->slug]);
        $location->save();

        session()->flash('success', 'Location updated successfully.');
        return redirect()->route('locations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();
        session()->flash('danger', 'Location deleted successfully.');
        return redirect()->route('locations.index');
    }
}
