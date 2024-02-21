@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Homepage</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('homepage.index') }}">Homepage</a></li>
                            <li class="breadcrumb-item active">Edit Homepage</li>
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
                                <h3 class="card-title">Edit Homepage</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('homepage.update', $homepage->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Page Name<span class="text-danger">*</label>
                                        <input id="pagenames" type="text"
                                            class="form-control @error('pagename') is-invalid @enderror" name="pagename"
                                            value="{{ $homepage->pagename }}">

                                        @error('pagename')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Section<span class="text-danger">*</label>
                                        <input id="sections" type="text"
                                            class="form-control @error('section') is-invalid @enderror" name="section"
                                            value="{{ $homepage->section }}">

                                        @error('section')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Sub section<span class="text-danger">*</label>
                                        <input id="subsections" type="text"
                                            class="form-control @error('subsection') is-invalid @enderror" name="subsection"
                                            value="{{ $homepage->subsection }}">
                                        @error('subsection')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Images<span class="text-danger">*</label>
                                        <div class="input-group">
                                            <div class="col-md-6">
                                                <input type="file"
                                                    class="form-control @error('logo') is-invalid @enderror" id="home_image"
                                                    name="logo">
                                            </div>
                                            @if (!empty($homepage->images))
                                                <div class="col-md-3">
                                                    <img src="{{ asset($homepage->images) }}" alt="Current Logo"
                                                        class="img-thumbnail" height="50" width="50" id="cLogo">
                                                    <i class="fas fa-trash text-danger" id="removelogo"
                                                        onClick="removeLogo()"></i>
                                                    <input type="hidden" id="removelogotxt" name="removelogotxt" value>
                                                    <i class="fas fa-undo text-danger" id="undoremovelogo"
                                                        onClick="undoLogo()" style="display: none";></i>
                                                </div>
                                            @endif
                                            @error('logo')
                                                <span class="error invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Edit</button>
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
        function removeLogo() {
            $('#removelogotxt').val('removed');
            $('#cLogo').attr('src', '{{ asset('Images/homepage/no-image.png') }}');
            $('#removelogo').hide();
            $('#undoremovelogo').show();
        }

        function undoLogo() {
            $('#removelogotxt').val(null);
            $('#cLogo').attr('src', '{{ asset($homepage->images) }}');
            $('#removelogo').show();
            $('#undoremovelogo').hide();
        }

    </script>

@endpush
