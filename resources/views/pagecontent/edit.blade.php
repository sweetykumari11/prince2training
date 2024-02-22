@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Page Content Form</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('pagedetail.index') }}">Page Content Form</a></li>
                            <li class="breadcrumb-item active">Edit  pagedetail</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit  pagedetail</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('pagedetail.update') }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group">
                                        <label>Page Name<span class="text-danger">*</label>
                                        <input type="text" id="pagenames"
                                            class="form-control @error('pagename') is-invalid @enderror" name="pagename"
                                            value="{{ old('pagename') }}">
                                        @error('pagename')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Section<span class="text-danger">*</label>
                                        <input type="text" id="sections"
                                            class="form-control @error('section') is-invalid @enderror" name="section"
                                            value="{{ old('section') }}">
                                        @error('section')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Sub Section<span class="text-danger">*</label>
                                        <input type="text" id="subsections"
                                            class="form-control @error('subsection') is-invalid @enderror" name="subsection"
                                            value="{{ old('subsection') }}">
                                        @error('subsection')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading<span class="text-danger">*</label>
                                        <input type="text" id="headings"
                                            class="form-control @error('heading') is-invalid @enderror" name="heading"
                                            value="{{ old('heading') }}">
                                        @error('Heading')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Content<span class="text-danger">*</label>
                                        <input type="text" id="contents"
                                            class="form-control @error('content') is-invalid @enderror" name="content"
                                            value="{{ old('content') }}">
                                        @error('content')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Page Tag Line<span class="text-danger">*</label>
                                        <input type="text" id="pagetaglines"
                                            class="form-control @error('pagetagline') is-invalid @enderror" name="pagetagline"
                                            value="{{ old('pagetagline') }}">
                                        @error('pagetagline')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Image<span class="text-danger">*</label>
                                        <input type="file" id="home_image"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            value="{{ old('image') }}">
                                        @error('image')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Image Alt<span class="text-danger">*</label>
                                        <input type="text" id="imagealts"
                                            class="form-control @error('imagealt') is-invalid @enderror" name="imagealt"
                                            value="{{ old('imagealt') }}">
                                        @error('imagealt')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Icon<span class="text-danger">*</label>
                                        <input type="file" id="icons"
                                            class="form-control @error('icon') is-invalid @enderror" name="icon"
                                            value="{{ old('icon') }}">
                                        @error('icon')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Icon Alt<span class="text-danger">*</label>
                                        <input type="text" id="iconalts"
                                            class="form-control @error('iconalt') is-invalid @enderror" name="iconalt"
                                            value="{{ old('iconalt') }}">
                                        @error('icon')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Content1<span class="text-danger">*</label>
                                        <input type="text" id="headingcontents1"
                                            class="form-control @error('headingcontent1') is-invalid @enderror" name="headingcontent1"
                                            value="{{ old('headingcontent1') }}">
                                        @error('headingsubcontent1')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Heading Subcontent1<span class="text-danger">*</label>
                                        <input type="text" id="headingsubcontents1"
                                            class="form-control @error('headingsubcontent1') is-invalid @enderror" name="headingsubcontent1"
                                            value="{{ old('headingsubcontent1') }}">
                                        @error('headingsubcontent1')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Content2<span class="text-danger">*</label>
                                        <input type="text" id="headingcontents2"
                                            class="form-control @error('headingcontent2') is-invalid @enderror" name="headingcontent2"
                                            value="{{ old('headingcontent2') }}">
                                        @error('headingcontent2')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Subcontent2<span class="text-danger">*</label>
                                        <input type="text" id="headingsubcontents2"
                                            class="form-control @error('headingsubcontent2') is-invalid @enderror" name="headingsubcontent2"
                                            value="{{ old('headingsubcontent2') }}">
                                        @error('headingsubcontent2')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Content3<span class="text-danger">*</label>
                                        <input type="text" id="headingcontents3"
                                            class="form-control @error('headingcontent3') is-invalid @enderror" name="headingcontent3"
                                            value="{{ old('headingcontent3') }}">
                                        @error('headingsubcontent3')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Subcontent3<span class="text-danger">*</label>
                                        <input type="text" id="headingsubcontents3"
                                            class="form-control @error('headingsubcontent3') is-invalid @enderror" name="headingsubcontent3"
                                            value="{{ old('headingsubcontent3') }}">
                                        @error('headingsubcontent3')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Content4<span class="text-danger">*</label>
                                        <input type="text" id="headingcontents4"
                                            class="form-control @error('headingcontent4') is-invalid @enderror" name="headingcontent4"
                                            value="{{ old('headingcontent4') }}">
                                        @error('headingsubcontent4')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Subcontent4<span class="text-danger">*</label>
                                        <input type="text" id="headingsubcontents4"
                                            class="form-control @error('headingsubcontent4') is-invalid @enderror" name="headingsubcontent4"
                                            value="{{ old('headingsubcontent4') }}">
                                        @error('headingsubcontent4')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('child-scripts')
    <script>
        $(document).ready(function() {
            $("#pagenames,#sections,#subsections,#home_image")
                .on("input", function() {
                    removeErrorMessages($(this));
                });

            function removeErrorMessages(inputField) {
                var parent = inputField.closest('.form-group');
                var errorElement = parent.find('.error');
                errorElement.remove();
                inputField.removeClass('is-invalid');
            }
        });
    </script>
@endpush
