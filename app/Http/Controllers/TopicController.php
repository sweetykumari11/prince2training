<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\Facades\Datatables;
use App\Http\Requests\TopicUpdateRequest;
use App\Mail\topiccreatedMail;
use App\Models\Tag;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if ($request->ajax()) {
        //     $query = Topic::with('creator', 'category');
        //     return Datatables::eloquent($query)->make(true);
        // }
        // return view('topic.list');

        if ($request->ajax()) {
            $query = Topic::with([
                'creator',
                'category',
                'countries' => function ($query) {
                    $query->select('countries.*', 'country_topics.deleted_at as pivot_deleted_at', 'country_topics.is_popular as pivot_is_popular');
                        //->where('country_id', session('country')->id);
                },
            ]);
            return Datatables::eloquent($query)->make(true);
        }
        return view('topic.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('topic.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TopicRequest $request): RedirectResponse
    {
        if ($request->file('logo')) {
            $logo = $request->file('logo');
            $logo_name = time() . '_' . $logo->getClientOriginalName();
            $logo_location = 'Images/logo/';
            $logo->move($logo_location, $logo_name);
        }

        $category_id = $request->category_id;
        $is_active = $request->is_active == "on" ? 1 : 0;

        $topic = Topic::create([
            'name' => $request->name,
            'category_id' => $category_id,
            'logo' => $logo_location . $logo_name,
            'is_active' => $is_active,
            'created_by' => Auth::user()->id
        ]);

        $topic->slugs()->create([
            'slug' => $request->slug,
        ]);

        // $message = (new topiccreatedMail($topic))->onQueue('emails');
        // Mail::to('arshdeep.singh@theknowledgeacademy.com')->later(now()->addSeconds(1), $message);

        session()->flash('success', 'Topic Created successfully.');
        return redirect()->route('topic.index');
    }

    public function show(string $id)
    {
    }

    public function edit(Topic $topic): View
    {
        $categories = Category::where('is_active', 1)->get();
        $slug = $topic->slugs()->first();
        return view('topic.edit', compact('topic', 'categories', 'slug'));
    }
    public function update(TopicUpdateRequest $request, Topic $topic): RedirectResponse
    {
        if ($request->hasFile('logo')) {
            $logo_location = 'Images/logo/';

            if (!empty($topic->logo)) {
                unlink(public_path($topic->logo));
            }

            $logo = $request->file('logo');
            $logo_name = time() . '_' . $logo->getClientOriginalName();
            $logo->move($logo_location, $logo_name);

            $topic->logo = $logo_location . $logo_name;
        }

        if ($request->input('removelogotxt')) {
            $topic->logo = null;
        }

        $is_active = $request->has('is_active') ? 1 : 0;

        $topic->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
            'logo' => $topic->logo,
            'is_active' => $is_active,
        ]);

        $topic->slugs()->update(['slug' => $request->slug]);

        session()->flash('success', 'Topic updated successfully.');

        return redirect()->route('topic.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic): RedirectResponse
    {
        $topic->delete();
        session()->flash('danger', 'Topic Deleted successfully.');
        return redirect()->route('topic.index');
    }
    public function updateStatus(Request $request)
    {
        $topic = Topic::find($request->id);
        $topic->is_active = $request->is_active;
        $topic->save();
        if ($request->is_active == 1) {
            return response()->json(['success' => 'Topic Activated']);
        } else {
            return response()->json(['success' => 'Topic Deactivated']);
        }
    }

    public function storeTopicCountry(Request $request)
    {
        $topic = Topic::find($request->topic_id);
        if ($request->checked == 'true') {
            $topic->countries()->sync([session('country')->id => ['deleted_at' => null]]);
        } else {
            $topic->countries()->updateExistingPivot(session('country')->id, [
                'deleted_at' => now(),
            ]);
        }
    }

    public function trashedTopic(Request $request)
    {
        if ($request->ajax()) {
            $trashedTopics = Topic::onlyTrashed();
            return Datatables::eloquent($trashedTopics)->make(true);
        }
        return view('trash.topic_list');
    }
    public function restore(Request $request, $id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);
        $topic->restore();
        session()->flash('success', 'Topic Restored successfully.');
        return redirect()->route('topic.index');
    }
    public function delete($id)
    {
        $topic = Topic::withTrashed()->findOrFail($id);
        $topic->forceDelete();
        session()->flash('danger', 'Topic Deleted successfully.');
        return view('trash.topic_list');
    }
    public function setPopular(Request $request)
    {
        $topic = Topic::find($request->id);
        $topic->countries()->updateExistingPivot(session('country')->id, [
            'is_popular' =>  $request->is_popular,
        ]);
        if ($request->is_popular == 1) {
            return response()->json(['success' => 'Topic Popular Activated']);
        } else {
            return response()->json(['success' => 'Topic Popular Deactivated']);
        }
    }
}
