@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Course Detail</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('course.coursedetails.index',$id) }}">Course Detail</a></li>
                        <li class="breadcrumb-item active">Edit Course Detail</li>
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
                            <h3 class="card-title">Edit Course</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('course.coursedetails.update', [$coursedetail->course_id, $coursedetail->id]) }}"

                                enctype="multipart/form-data">
                              @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Course Name<span class="text-danger">*</span></label>
                                    <select name="course_id" id="topic_name"
                                        class="form-control select2bs4 @error('course_id') is-invalid @enderror">
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" {{ $course->id == $coursedetail->course_id ? 'selected' : '' }}>
                                                {{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Country<span class="text-danger">*</span></label>
                                    <select name="country_id" id="country_id"
                                        class="form-control select2bs4 @error('country_id') is-invalid @enderror">
                                        <option value="">Select a country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"{{ $country->id == $coursedetail->country_id ? 'selected' : '' }}>
                                                {{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Heading<span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="5" name="heading">{{ old('heading',$coursedetail->heading) }}</textarea>
                                    @error('heading')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Summary<span class="text-danger">*</span></label>
                                    <textarea id="summary" class="form-control @error('summary') is-invalid @enderror" rows="5"name="summary">{{ old('summary',$coursedetail->summary) }}</textarea>
                                    @error('summary')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Detail<span class="text-danger">*</span></label>
                                    <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" rows="5"name="detail">{{ old('detail',$coursedetail->detail) }}</textarea>
                                    @error('detail')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Overview<span class="text-danger">*</span></label>
                                    <textarea id="summernote" class="summernote @error('overview') is-invalid @enderror" name="overview">{{ old('overview',$coursedetail->overview) }}</textarea>
                                    @error('overview')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>What's included<span class="text-danger">*</span></label>
                                    <textarea id="summernote" class="summernote @error('whats_included') is-invalid @enderror" name="whats_included">{{ old('whats_included',$coursedetail->whats_included) }}</textarea>
                                    @error('whats_included')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Pre-requisite<span class="text-danger">*</span></label>
                                    <textarea id="summernote" class="summernote @error('pre_requisite') is-invalid @enderror" name="pre_requisite">{{ old('pre_requisite',$coursedetail->pre_requisite) }}</textarea>
                                    @error('pre_requisite')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Who should Attend<span class="text-danger">*</span></label>
                                    <textarea id="summernote" class="summernote @error('who_should_attend') is-invalid @enderror" name="who_should_attend">{{ old('who_should_attend',$coursedetail->who_should_attend) }}</textarea>
                                    @error('who_should_attend')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Meta Title<span class="text-danger">*</span></label>
                                    <input type="text" id="meta_title"
                                        class="form-control @error('meta_title') is-invalid @enderror" name="meta_title"
                                        value="{{ old('meta_title',$coursedetail->meta_title) }}">
                                    @error('meta_title')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Meta Keywords<span class="text-danger">*</span></label>
                                    <input type="text" id="meta_keywords"
                                        class="form-control @error('meta_keywords') is-invalid @enderror"
                                        name="meta_keywords" value="{{ old('meta_keywords',$coursedetail->meta_keywords) }}">
                                    @error('meta_keywords')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Meta Description<span class="text-danger">*</span></label>
                                    <input type="text" id="meta_description"
                                        class="form-control @error('meta_description') is-invalid @enderror"
                                        name="meta_description" value="{{ old('meta_description',$coursedetail->meta_description) }}">
                                    @error('meta_description')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                @foreach ($coursedetail->logActivities as $activity)
                                    <div class="time-label">
                                        <span class="bg-red">{{ $activity->created_at->format('d-M-Y h:i A')  }}</span>
                                    </div>

                                    <div>
                                        <i class="fas fa-solid fa-pen bg-blue"></i>
                                        <div class="timeline-item">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $activity->creator ? $activity->creator->name : '' }}</h3>
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
        </div>
    </section>
@endsection
@push('child-scripts')
<script>
    $(document).ready(function() {
        $("#summernote").summernote({
            height: 300,
            focus: true,
        });
    });
</script>
@endpush


