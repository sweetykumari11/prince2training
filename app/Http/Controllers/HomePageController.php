<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homepage;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\StoreHomepageRequest;
use App\Http\Requests\UpdateHomepageRequest;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Homepage::query();
            return Datatables::eloquent($query)->make(true);
        }
        return view('homepage.list');
    }
    public function create()
    {
        return view('homepage.create');
    }
    public function store(StoreHomepageRequest $request)
    {

        if ($request->file('image')) {
            $icon = $request->file('image');
            $icon_name = time() . '_' . $icon->getClientOriginalName();

            // File upload location
            $icon_location = 'Images/homepage/';

            // Upload file
            $icon->move($icon_location, $icon_name);
        }
        Homepage::create([
            'pagename' => $request->pagename,
            'section' => $request->section,
            'subsection' => $request->subsection,
            'images' => $icon_location . $icon_name,
            'created_by' => Auth::user()->id
        ]);
        session()->flash('success', 'HomePage Created successfully.');
        return redirect()->route('homepage.index');
    }
    public function edit(Homepage $homepage)
    {
        // print_r($homepage);
        return view('homepage.edit', compact('homepage'));
    }
    public function update(UpdateHomepageRequest $request, Homepage $homepage)
    {


        $homepage->pagename = $request->pagename;
        $homepage->section = $request->section;
        $homepage->subsection = $request->subsection;
        $homepage->save();
        return redirect()->route('homepage.index')->with('success', 'Homepage Updated Successfully');
    }

    public function destroy(Homepage $homepage)
    {

        $homepage->delete();
        session()->flash('danger', 'Homepage Deleted successfully.');
        return redirect()->route('homepage.index');
    }
}
