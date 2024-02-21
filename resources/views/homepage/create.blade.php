@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('homepage.index') }}">Homepage</a></li>
                            <li class="breadcrumb-item active">Create Homepage</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Homepage</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('homepage.store') }}" enctype="multipart/form-data">
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
                                        <label>Images<span class="text-danger">*</label>
                                        <input type="file" id="home_image"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            value="{{ old('image') }}">
                                        @error('image')
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
