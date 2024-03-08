<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Topic;
use App\Models\Course;

use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditFaqRequest;
use Yajra\DataTables\Facades\Datatables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $segment = $uriSegments[1];
        if ($request->ajax()) {
            $query = Faq::with('creator');

            if ($segment === 'topic') {
                $query->where('entity_id', $id);
                $query->where('entity_type', 'App\Models\Topic');
            } elseif ($segment === 'course') {
                $query->where('entity_id', $id);
                $query->where('entity_type', 'App\Models\Course');
            }

            return Datatables::eloquent($query)->make(true);
        }
        return view('faq.list', compact('id', 'segment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $segment = $uriSegments[1];
        return view('faq.create', compact('id', 'segment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($id, FaqRequest $request)
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $segment = $uriSegments[1];

        if ($segment  === 'topic') {
            $entity =  Topic::findOrFail($id);
        } elseif ($segment  === 'course') {
            $entity =  Course::findOrFail($id);
        }

        $is_active = $request->is_active == "on" ? 1 : 0;
        $entity->faqs()->create([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => $is_active,
            'created_by' => Auth::user()->id
        ]);

        if ($segment  === 'topic') {
            return redirect()->route('topic.faqs.index', $id)
                ->with('success', 'Faq created successfully.');
        } elseif ($segment  === 'course') {
            return redirect()->route('course.faqs.index', $id)
                ->with('success', 'Faq created successfully.');
        }
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
    public function edit($id, Faq $faq)
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $segment = $uriSegments[1];
        return view('faq.edit', compact('id', 'faq', 'segment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, EditFaqRequest $request, Faq $faq)
    {
        $is_active = $request->is_active == "on" ? 1 : 0;
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'is_active' => $is_active
        ]);
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if ($uriSegments[1] === 'topic') {
            return redirect()->route('topic.faqs.index', $id)
                ->with('success', 'Faq created successfully.');
        } elseif ($uriSegments[1] === 'course') {
            return redirect()->route('course.faqs.index', $id)
                ->with('success', 'Faq created successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, Faq $faq)
    {
        $faq->delete();
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if ($uriSegments[1] === 'topic') {
            return redirect()->route('topic.faqs.index', $id)
                ->with('success', 'Faq deleted successfully.');
        } elseif ($uriSegments[1] === 'course') {
            return redirect()->route('course.faqs.index', $id)
                ->with('success', 'Faq deleted successfully.');
        }
    }
    // public function faqStatus(Request $request){
    //     $faq= Faq::find($request->id);
    //     $faq->is_active = $request->is_active;
    //     $faq->save();

    //     if($request->is_active==1 && $faq->entity_type=='Topic'){
    //         return response()->json(['success' => 'Topic Activated']);
    //     }
    //     elseif($request->is_active==1 && $faq->entity_type=='Course'){
    //         return response()->json(['success' => 'course Activated']);

    //     }
    //     if($request->is_active==0 && $faq->entity_type=='Topic'){
    //         return response()->json(['success' => 'Topic Deactivated']);
    //     }
    //     elseif($request->is_active==0 && $faq->entity_type=='Course'){
    //         return response()->json(['success' => 'course  Deactivated']);

    //     }
    // }
}
