@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>PageContent</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('pagecontent.index') }}">PageContent</a></li>
                        <li class="breadcrumb-item active">Edit PageContent</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit PageContent</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="POST" action="{{ route('pagecontent.update', $pagecontent->id) }}"
                    enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    @method('PUT')
                    <div class="form-group">
                        <label for="page_name">Page Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('page_name') is-invalid @enderror" id="page_name"
                            name="page_name" value="{{ $pageContent->page_name }}">
                        @error('page_name')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="section">Section<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('section') is-invalid @enderror" id="section"
                            name="section" value="{{ $pageContent->section }}">
                        @error('section')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Content<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ $pageContent->content }}</textarea>
                        @error('content')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tagline">Tagline<span class="text-danger">*</span></label>
                        <textarea class="form-control @error('tagline') is-invalid @enderror" id="tagline" name="tagline">{{ $pageContent->tagline }}</textarea>
                        @error('tagline')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                                name="image">
                            @if ($pageContent->image)
                                <div class="col-md-3">
                                    <img src="{{ asset($pageContent->image) }}" alt="Current featured image"
                                        class="img-thumbnail" height="50" width="50" id="current_image">
                                    <i class="fas fa-trash text-danger" id="removeCurrentImage"
                                        onclick="removeCurrentImage()"></i>
                                    <input type="hidden" id="removeImage" name="removeImage" value>
                                    <i class="fas fa-undo text-danger" id="undoRemoveImage" onclick="undoRemoveImage()"
                                        style="display: none;"></i>
                                </div>
                                @error('image')
                                    <span class="error invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            @else
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="image_alt">Image Alt</label>
                        <input type="text" class="form-control @error('image_alt') is-invalid @enderror" id="image_alt"
                            name="image_alt" value="{{ $pageContent->image_alt }}">
                        @error('image_alt')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="icon">Icon<span class="text-danger">*</label>
                        <div class="input-group">
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('icon') is-invalid @enderror"
                                    id="icon" name="icon">
                            </div>
                            @if ($pageContent->icon)
                                <div class="col-md-3">
                                    <img src="{{ asset($pageContent->icon) }}" alt="Current Icon" class="img-thumbnail"
                                        height="50" width="50" id="cIcon">
                                    <i class="fas fa-trash text-danger" id="removeicon" onClick="removeIcon()"></i>
                                    <input type="hidden"id="removeicontxt" name="removeicontxt" value>
                                    <i class="fas fa-undo text-danger" id="undoremoceicon" onClick="undoIcon()"
                                        style="display: none";></i>
                                </div>
                            @endif
                            @error('icon')
                                <span class="error invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="icon_alt">Icon Alt</label>
                        <input type="text" class="form-control @error('icon_alt') is-invalid @enderror" id="icon_alt"
                            name="icon_alt" value="{{ $pageContent->icon_alt }}">
                        @error('icon_alt')
                            <span class="error invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_active"
                                {{ $blog->is_active ? 'checked' : '' }}>
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
    </div>
    </section>
@endsection
@push('child-scripts')
    <script>
        function removeIcon() {
            $('#removeicontxt').val('removed');
            $('#cIcon').attr('src', '{{ asset('Images/icon/no-image.png') }}');
            $('#removeicon').hide();
            $('#undoremoveicon').show();
        }

        function undoIcon() {
            $('#removeicontxt').val(null);
            $('#cIcon').attr('src', '{{ asset($pagecontent->icon) }}');
            $('#removeicon').show();
            $('#undoremoveicon').hide();
        }

        function removeImage() {
            $('#removeimagetxt').val('removed');
            $('#cImage').attr('src', '{{ asset('Images/icon/no-image.png') }}');
            $('#removeimage').hide();
            $('#undoremoveimage').show();
        }

        function undoImage() {
            $('#removeimagetxt').val(null);
            $('#cImage').attr('src', '{{ asset($pagecontent->image) }}');
            $('#removeimage').show();
            $('#undoremoveimage').hide();
        }
    </script>
@endpush
