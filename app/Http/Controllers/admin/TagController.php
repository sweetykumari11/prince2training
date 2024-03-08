<?php

namespace App\Http\Controllers\admin;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Requests\TagUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:tag-list|tag-insert|tag-update|tag-delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:tag-insert', ['only' => ['insert','store']]);
        //  $this->middleware('permission:tag-update', ['only' => ['update','update']]);
        //  $this->middleware('permission:tag-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Tag::get();
            return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('creator_name', function($row){ 
                return $row->creator ? $row->creator->name : '';      
            })
            ->make(true);
        }
        return view('admin.tag.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::where('is_active', 1)->get();
        return view('admin.tag.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request): RedirectResponse
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        Tag::create([
            'name' => $request->name,
            'is_active' => $is_active,
            'created_by' => Auth::user()->id
        ]);
        session()->flash('success', 'Tag Created successfully.');
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag): View
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagUpdateRequest $request, Tag $tag): RedirectResponse
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        $tag->update([
            'name' => $request->name,
            'is_active' => $is_active
        ]);
        session()->flash('success', 'Tag updated successfully.');
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->delete();
        session()->flash('danger', 'Tag Deleted successfully.');
        return redirect()->route('tag.index');
    }
    public function tagStatus(Request $request){
        $tag = Tag::find($request->id);
        $tag->is_active = $request->is_active;
        $tag->save();
        if($request->is_active==1){
            return response()->json(['success' => 'Tag Activated']);
        }else{
            return response()->json(['success' => 'Tag Activated']);
        }
    }

    public function trashedTag(Request $request)
    {
        if ($request->ajax()) {
            $trashedTags = Tag::onlyTrashed();
            return Datatables::eloquent($trashedTags)->make(true);
        }

        return view('trash.tag_list');
    }

    public function restoreTag($id)
    {
        $tag = Tag::withTrashed()->findOrFail($id);
        $tag->restore();
        session()->flash('success', 'Tag Restored successfully.');
        return redirect()->route('tag.index');
    }

    public function deleteTag($id)
    {
        $tag = Tag::withTrashed()->findOrFail($id);
        $tag->forceDelete();
        session()->flash('danger', 'Tag Deleted successfully.');
        return view('trash.tag_list');
    }
}

