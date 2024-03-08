<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use App\Models\Country;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Country::query();
            return Datatables::eloquent($query)->make(true);
        }
        return view('country.list');
    }
    public function create()
    {
        return view('country.create');
    }
    public function store(CountryRequest $request)
    {

        $is_active = $request->is_active == "on" ? 1 : 0;
        $is_popular = $request->is_popular == "on" ? 1 : 0;
        if ($request->file('flagimage')) {
            $flagimages = $request->file('flagimage');
            $flagimagename = time() . '_' . $flagimages->getClientOriginalName();
            $flagimagelocation = 'Images/countryimage/';
            $flagimages->move($flagimagelocation, $flagimagename);
            $flagpath = $flagimagelocation . $flagimagename;
        }
         Country::create([
            "name" => $request->name,
            "country_code" => $request->countrycode,
            "description" => $request->description,
            "iso3" => $request->iso3,
            "currency" => $request->currency,
            "currency_symbol" => $request->currency_symbol,
            "currency_symbol_html" => $request->currency_symbol_html,
            "currency_title" => $request->currency_title,
            "flagimage" => $flagpath,
            "is_active" => $is_active,
            "is_popular" => $is_popular,
            "created_by" => Auth::user()->id

        ]);
        return redirect()->route('countries.index')->with('success', 'Country Created Successfully.');




    }
    public function edit(Country $country)
    {

         return view('country.edit', compact('country'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, country $country)
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        $is_popular = $request->is_popular == "on" ? 1 : 0;
        $country->name = $request->name;
        $country->country_code = $request->country_code;
        $country->description = $request->description;
        $country->iso3 = $request->iso3;
        $country->currency = $request->currency;
        $country->currency_symbol = $request->currency_symbol;
        $country->currency_symbol_html = $request->currency_symbol_html;
        $country->currency_title = $request->currency_title;
        $country->is_active = $is_active;
        $country->is_popular = $is_popular;
        if ($request->file('flag_image')) {
            $flogimagelocation = 'Images/countryimage/';
            if (!empty($country->flagimage)) {
                unlink(public_path($country->flagimage));
            }
            $flagimage = $request->file('flag_image');
            $flagimage_name = time() . '_' . $flagimage->getClientOriginalName();
            $flagimage->move($flogimagelocation, $flagimage_name);
            $country->flagimage = $flogimagelocation . $flagimage_name;
        }
        if ($request['removeflagimages'] != null) {
            $country->flagimage = null;
        }
        $country->save();

        return redirect()->route('countries.index')->with('success', 'Country Updated Successfully');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('countries.index')->with('danger', 'Country Deleted Successfully');
    }
    public function countryStatus(Request $request){
        $country = Country::find($request->id);
        $country->is_active = $request->is_active;
        $country->save();
        if ($request->is_active == 1) {
            return response()->json(['success' => 'Country Activated']);
        } else {
            return response()->json(['success' => 'Country Deactivated']);
        }

    }
}
