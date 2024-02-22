<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageContent;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\StorePagedetailRequest;
use App\Http\Requests\UpdatePagedetailRequest;
use Illuminate\Support\Facades\Auth;

class PageContentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = PageContent::query();
            return Datatables::eloquent($query)->make(true);
        }
        return view('pagedetail.list');
    }
    public function create()
    {
        return view('pagedetail.create');
    }
    public function store(StorePagedetailRequest $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image_location = 'Images/pagedetail/';
            $image->move($image_location, $image_name);
            $image = $image_location . $image_name;
        }
        if ($request->file('icon')) {
            $icon = $request->file('icon');
            $icon_name = time() . '_' . $icon->getClientOriginalName();
            $icon_location = 'Images/pagedetail/';
            $icon->move($icon_location, $icon_name);
            $icon = $icon_location . $icon_name;
        }
        PageContent::create([
            'page_name' => $request->pagename,
            'section' => $request->section,
            'sub_section' => $request->subsection,
            'heading' => $request->heading,
            'content' => $request->content,
            'page_tag_line' => $request->pagetagline,
            'image' => $image,
            'image_alt' => $request->imagealt,
            'icon' => $icon,
            'icon_alt' => $request->iconalt,
            'heading_subcontent1' => $request->headingsubcontent1,
            'heading_subcontent2' => $request->headingsubcontent2,
            'heading_subcontent3' => $request->headingsubcontent3,
            'heading_subcontent4' => $request->headingsubcontent4,
            'created_by' => Auth::user()->id
        ]);
        session()->flash('success', 'pagedetail Created successfully.');
        return redirect()->route('pagedetail.index');
    }
    public function edit(Homepage $homepage)
    {
        return view('pagedetail.edit', compact('homepage'));
    }
    public function update(UpdatePagedetailRequest $request, Homepage $homepage)
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
        return redirect()->route('pagedetail.index');
    }
}
