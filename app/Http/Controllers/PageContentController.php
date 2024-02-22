<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\UpdatePagedetailRequest;
use App\Http\Requests\StorePagecontentRequest;


class PageContentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = PageContent::query();
            return Datatables::eloquent($query)->make(true);
        }
        return view('pagecontent.list');
    }
    public function create()
    {
        return view('pagecontent.create');
    }
    public function store(StorePagecontentRequest $request)
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
            'heading_content1' => $request->headingcontent1,
            'heading_subcontent1' => $request->headingsubcontent1,
            'heading_content2' => $request->headingcontent2,
            'heading_subcontent2' => $request->headingsubcontent2,
            'heading_content3' => $request->headingcontent3,
            'heading_subcontent3' => $request->headingsubcontent3,
            'heading_content4' => $request->headingcontent4,
            'heading_subcontent4' => $request->headingsubcontent4,
            'created_by' => Auth::user()->id
        ]);
        session()->flash('success', 'pagedetail Created successfully.');
        return redirect()->route('pagecontent.index');
    }
    public function edit(PageContent $pagedetail)
    {
        return view('pagecontent.edit', compact('pagedetail'));
    }
    public function update(StorePagecontentRequest $request, $id)
    {
        $pageContent = PageContent::findOrFail($id);

        if ($request->file('image')) {
            $image = $request->file('image');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $image_location = 'Images/pagedetail/';
            $image->move($image_location, $image_name);
            $pageContent->image = $image_location . $image_name;
        }

        if ($request->file('icon')) {
            $icon = $request->file('icon');
            $icon_name = time() . '_' . $icon->getClientOriginalName();
            $icon_location = 'Images/pagedetail/';
            $icon->move($icon_location, $icon_name);
            $pageContent->icon = $icon_location . $icon_name;
        }

        $pageContent->update([
            'page_name' => $request->pagename,
            'section' => $request->section,
            'sub_section' => $request->subsection,
            'heading' => $request->heading,
            'content' => $request->content,
            'page_tag_line' => $request->pagetagline,
            'image_alt' => $request->imagealt,
            'icon_alt' => $request->iconalt,
            'heading_content1' => $request->headingcontent1,
            'heading_subcontent1' => $request->headingsubcontent1,
            'heading_content2' => $request->headingcontent2,
            'heading_subcontent2' => $request->headingsubcontent2,
            'heading_content3' => $request->headingcontent3,
            'heading_subcontent3' => $request->headingsubcontent3,
            'heading_content4' => $request->headingcontent4,
            'heading_subcontent4' => $request->headingsubcontent4,
            // Assuming 'created_by' should not be updated during editing
        ]);

        session()->flash('success', 'Page detail updated successfully.');
        return redirect()->route('pagedetail.index');
    }


    public function destroy(PageContent $PageContent)
    {
        $PageContent->delete();
        session()->flash('danger', 'pagedetail Deleted successfully.');
        return redirect()->route('pagedetail.index');
    }
}
