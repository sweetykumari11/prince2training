<?php

namespace App\Http\Controllers;

use App\Models\Tag;

use App\Models\Blog;
use App\Models\Country;
use App\Models\Category;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use App\Mail\BlogcreatedMail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EditBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use Yajra\DataTables\Facades\Datatables;

class BlogController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:blog-list|blog-insert|blog-update|blog-delete', ['only' => ['index', 'store']]);
    //     $this->middleware('permission:blog-insert', ['only' => ['insert', 'store']]);
    //     $this->middleware('permission:blog-update', ['only' => ['update', 'update']]);
    //     $this->middleware('permission:blog-delete', ['only' => ['destroy']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Blog::with([
                'creator',
                'countries' => function ($query) {
                    $query->select('countries.*', 'country_blog.deleted_at as pivot_deleted_at','country_blog.is_popular as pivot_is_popular');
                },
            ])->get();
            //->where('country_id', session('country')->id);
            return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('category_name', function($row){ 
                return $row->category ? $row->category->name : '';      
            })
            ->make(true);
        }
        return view('blog.list');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::where('is_active', 1)->get();
        $country = Country::all();
        $tags = Tag::where('is_active', 1)->get();
        return view('blog.create', compact('category', 'tags', 'country'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $image1 = $request->file('featured_img1');
        $image1name = time() . '_' . $image1->getClientOriginalName();
        $image1location = 'Images/featureimage1/';
        $image1->move($image1location, $image1name);
        $filepath1 = $image1location . $image1name;

        $image2 = $request->file('featured_img2');
        $image2name = time() . '_' . $image2->getClientOriginalName();
        $image2location = 'Images/featureimage2/';
        $image2->move($image2location, $image2name);
        $filepath2 = $image2location . $image2name;

        $id = auth()->user()->id;
        if ($request->is_popular == 'on') {
            $popular = '1';
        } else {
            $popular = '0';
        }
        $is_active = $request->is_active2 == "on" ? 1 : 0;
        $blog = Blog::create([
           "category_id" => $request->category_id,
            "title" => $request->title,
            "short_description" => $request->short_description,
            "featured_img1" => $filepath1,
            "featured_img2" => $filepath2,
            "author_name" => $request->author_name,
            "is_popular" => $popular,
            "views_count" => $request->views_count,
            "order_sequence" => $request->order_sequence,
            "added_date" => $request->added_date,
            "created_by" => $id,
            "is_active" => $is_active,
            "country_id" => $request->country_id,
            "created_by" => Auth::user()->id
        ]);
        $blog->slugs()->create(['slug' => $request->slug,]);

        $tags = $request->tags;
        if (!empty($tags)) {
            $tagIds = [];
            foreach ($tags as $tagname) {
                $tag = Tag::find($tagname);

                if (!$tag) {
                    $newTag = new Tag();
                    $newTag->name = $tagname;
                    $newTag->save();
                    $tagIds[] = $newTag->id;
                } else {
                    $tagIds[] = $tag->id;
                }
            }
            $blog->tags()->sync($tagIds);
        }
        // $message = (new BlogcreatedMail($blog))->onQueue('emails');
        // Mail::to('arshdeep.singh@theknowledgeacademy.com')->later(now()->addSeconds(1), $message);

        return redirect()->route('blogs.index')->with('success', 'Blog Created Successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
       // print_r($blog);
       // die();
        $tags = Tag::all();
        $category = category::where('is_active', 1)->get();
        $country = Country::all();
        $slug = $blog->slugs()->first();
        return view('blog.edit', compact('blog', 'category', 'slug', 'tags', 'country'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(EditBlogRequest $request, Blog $blog)
    {
        if ($request->is_popular == 'on') {
            $popular = '1';
        } else {
            $popular = '0';
        }
        $is_active = $request->is_active == "on" ? 1 : 0;
        $blog->is_active = $is_active;
        $blog->category_id = $request->category_id;
        $blog->is_popular = $popular;
        $blog->title = $request->title;
        $blog->short_description = $request->short_description;
        $blog->country_id = $request->country_id;
        $blog->country_id = '1';
        $blog->author_name = $request->author_name;
        $blog->added_date = $request->added_date;
        $blog->slugs()->updateOrCreate(['slug' => $request->slug]);
        if ($request->file('featured_img1')) {
            $featureimage1location = 'Images/featureimage1/';
            if (!empty($blog->featured_img1)) {
                unlink(public_path($blog->featured_img1));
            }
            $feature_image1 = $request->file('featured_img1');
            $featureimg1_name = time() . '_' . $feature_image1->getClientOriginalName();
            $feature_image1->move($featureimage1location, $featureimg1_name);
            $blog->featured_img1 = $featureimage1location . $featureimg1_name;
        }
        if ($request['removefeature1txt'] != null) {
            $blog->featured_img1 = null;
        }
        if ($request->file('featured_img2')) {
            $featureimage2location = 'Images/featureimage2/';
            if (!empty($blog->featured_img2)) {
                unlink(public_path($blog->featured_img2));
            }
            $feature_image2 = $request->file('featured_img2');
            $featureimg2_name = time() . '_' . $feature_image2->getClientOriginalName();
            $feature_image2->move($featureimage2location, $featureimg2_name);
            $blog->featured_img2 = $featureimage2location . $featureimg2_name;
        }
        if ($request['removefeature2txt'] != null) {
            $blog->featured_img2 = null;
        }


        $tags = $request->tags;
        if (!empty($tags)) {
            $tagIds = [];
            foreach ($tags as $tagname) {
                $tag = Tag::find($tagname);

                if (!$tag) {
                    $newTag = new Tag();
                    $newTag->name = $tagname;
                    $newTag->save();
                    $tagIds[] = $newTag->id;
                } else {
                    $tagIds[] = $tag->id;
                }
            }
            $blog->tags()->sync($tagIds);
        }

        $blog->save();
        $blog->slugs()->update(['slug' => $request->slug]);

        return redirect()->route('blogs.index')->with('success', 'Blog Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('danger', 'Blog Deleted Successfully');
    }
    public function blogStatus(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->is_active = $request->is_active;
        $blog->save();
        if ($request->is_active == 1) {
            return response()->json(['success' => 'Blog Activated']);
        } else {
            return response()->json(['success' => 'Blog Deactivated']);
        }
    }
    public function storeblogcountry(Request $request)
    {
        $blog = Blog::find($request->id);
        if ($request->checked == 'true') {
            $blog->countries()->sync([session('country')->id => ['deleted_at' => null]]);
        } else {
            $blog->countries()->updateExistingPivot(session('country')->id, [
                'deleted_at' => now(),
            ]);
        }
    }
    public function setPopular(Request $request){

        $blog = Blog::find($request->id);
        $blog->countries()->updateExistingPivot(session('country')->id, [
            'is_popular' =>  $request->is_popular,
        ]);
        if ($request->is_popular == 1) {
            return response()->json(['success' => 'Blog Popular Activated']);
        } else {
            return response()->json(['success' => 'Blog Popular Deactivated']);
        }

    }
    public function trashedBlog(Request $request)
    {
        if ($request->ajax()) {
            $trashedBlogs = Blog::onlyTrashed();
            return Datatables::eloquent($trashedBlogs)->make(true);
        }
        return view('trash.blog_list');
    }
    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->restore();
        session()->flash('success', 'Blog Restored successfully.');
        return redirect()->route('blogs.index');
    }
    public function delete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->forceDelete();
        session()->flash('danger', 'Blog Deleted successfully.');
        return view('trash.blog_list');
    }

}
