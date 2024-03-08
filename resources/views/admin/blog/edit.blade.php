@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Blog</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blog</a></li>
                        <li class="breadcrumb-item active">Edit Blog</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Blog</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('blogs.update', $blog->id) }}"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                @method('PUT')
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id"
                                        class="form-control select2bs4 @error('category_id') is-invalid @enderror">
                                        <option value="">--Select a category--</option>
                                        @foreach ($category as $categories)
                                            <option value="{{ $categories->id }}"
                                                {{ $categories->id == $blog->category_id ? 'selected' : '' }}>
                                                {{ $categories->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                        name="slug" value="{{ $slug ? $slug->slug : '' }}">
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $blog->title }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Short description</label>
                                    <input type="text"
                                        class="form-control @error('short_description') is-invalid @enderror"
                                        name="short_description" value="{{ $blog->short_description }}">
                                    @error('short_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Country</label>
                                    <select name="country_id"
                                        class="form-control select2bs4 @error('country_id') is-invalid @enderror">
                                        <option value="">Select a Country</option>
                                        @foreach ($country as $countries)
                                            <option value="{{ $countries->id }}"
                                                {{ $countries->id == $blog->country_id ? 'selected' : '' }}>
                                                {{ $countries->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="icon">Featured image1</label>
                                    <div class="input-group">
                                        <div class="col-md-6">
                                            <input type="file"
                                                class="form-control @error('featured_img1') is-invalid @enderror"
                                                id="featured_img1" name="featured_img1">
                                        </div>
                                        @if ($blog->featured_img1)
                                            <div class="col-md-3">
                                                <img src="{{ asset($blog->featured_img1) }}" alt="Current feature image 1"
                                                    class="img-thumbnail" height="50" width="50" id="fimg1">
                                                <i class="fas fa-trash text-danger" id="removefeatureimage1"
                                                    onClick="removefeatureimage1()"></i>
                                                <input type="hidden"id="removefeature1txt" name="removefeature1txt" value>
                                                <i class="fas fa-undo text-danger" id="undoremovefimage1"
                                                    onClick="undofeatureimage1()" style="display: none";></i>
                                            </div>
                                            @error('featured_img1')
                                                <span class="error invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @else
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="icon">Featured image2</label>
                                    <div class="input-group">
                                        <div class="col-md-6">
                                            <input type="file"
                                                class="form-control @error('featured_img2') is-invalid @enderror"
                                                id="featured_img2" name="featured_img2">

                                        </div>
                                        @if ($blog->featured_img2)
                                            <div class="col-md-3">
                                                <img src="{{ asset($blog->featured_img2) }}" alt="Current feature image 2"
                                                    class="img-thumbnail" height="50" width="50" id="fimg2">
                                                <i class="fas fa-trash text-danger" id="removefeatureimage2"
                                                    onClick="removefeatureimage2()"></i>
                                                <input type="hidden"id="removefeature2txt" name="removefeature2txt" value>
                                                <i class="fas fa-undo text-danger" id="undoremovefimage2"
                                                    onClick="undofeatureimage2()" style="display: none";></i>
                                            </div>
                                            @error('featured_img2')
                                                <span class="error invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @else
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Author Name</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('author_name') is-invalid @enderror"
                                            name="author_name" value="{{ $blog->author_name }}">
                                        @error('author_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Date</label>
                                    <div class="input-group">
                                        <input type="date"
                                            class="form-control @error('added_date') is-invalid @enderror"
                                            name="added_date" value="{{ $blog->added_date }}">
                                        @error('added_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Tags</label>
                                    <select class="select2" name="tags[]" multiple="multiple" style="width: 100%;"
                                        id="pieces">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                {{ $blog->tags->contains('id', $tag->id) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch"
                                            name="is_popular" {{ $blog->is_popular ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch">Popular</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                            name="is_active" {{ $blog->is_active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch1">Active</label>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Activity</h3>
                        </div>
                        <div class="card-body">
                            <!-- The time line -->
                            <div class="timeline">
                                <!-- timeline time label -->
                                @foreach ($blog->logActivities as $activity)
                                    <div class="time-label">
                                        <span class="bg-red">{{ $activity->created_at->format('d-M-Y h:i A') }}</span>
                                    </div>

                                    <div>
                                        <i class="fas fa-solid fa-pen bg-blue"></i>
                                        <div class="timeline-item">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $activity->creator->name ?? '' }}</h3>
                                            </div>
                                            <h3 class="timeline-header no-border"> {{ $activity->activity }} </a></h3>
                                        </div>
                                    </div>
                                @endforeach

                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </section>
@endsection

@push('child-scripts')
    <script>
        $(document).ready(function() {
            var t = $('#summernote').summernote({
                height: 300,
                focus: true
            });
        });

        function removefeatureimage1() {
            $('#removefeature1txt').val('removed');
            $('#fimg1').attr('src', '{{ asset('Images/featureimage1/no-image.png') }}');
            $('#removefeatureimage1').hide();
            $('#undoremovefimage1').show();
        }

        function undofeatureimage1() {
            $('#removefeature1txt').val(null);
            $('#fimg1').attr('src', '{{ asset($blog->featured_img1) }}');
            $('#removefeatureimage1').show();
            $('#undoremovefimage1').hide();
        }

        function removefeatureimage2() {
            $('#removefeature2txt').val('removed');
            $('#fimg2').attr('src', '{{ asset('Images/featureimage2/no-image.png') }}');
            $('#removefeatureimage2').hide();
            $('#undoremovefimage2').show();
        }

        function undofeatureimage2() {
            $('#removefeature2txt').val(null);
            $('#fimg2').attr('src', '{{ asset($blog->featured_img2) }}');
            $('#removefeatureimage2').show();
            $('#undoremovefimage2').hide();
        }
    </script>
@endpush
