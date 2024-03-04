@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                            <li class="breadcrumb-item active">Create category</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create category</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name<span class="text-danger">*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" placeholder="Enter name">

                                        @error('name')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug<span class="text-danger">*</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" placeholder="Enter slug">

                                        @error('slug')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Icon<span class="text-danger">*</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="icon"
                                                    class="form-control @error('icon') is-invalid @enderror" id="icon"
                                                    name="icon">
                                            </div>
                                        </div>
                                        @error('icon')
                                            <span class="error invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">logo<span class="text-danger">*</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                                id="logo" name="logo">
                                        </div>
                                        @error('logo')
                                            <span class="error invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Content<span class="text-danger">*</span></label>
                                        <textarea id="summernote" class="summernote @error('content') is-invalid @enderror" name="content">{{ old('content') }}</textarea>
                                        @error('content')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="is_active"
                                                id="customSwitch1" checked>
                                            <label class="custom-control-label" for="customSwitch1">Active</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="is_popular"
                                                id="customSwitch2" checked>
                                            <label class="custom-control-label" for="customSwitch2">Popular</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="is_technical"
                                                id="customSwitch3" checked>
                                            <label class="custom-control-label" for="customSwitch3">Technical</label>
                                        </div>
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

            $('#name,#slug,#icon,#logo').on('input', function() {
                removeErrorMessages($(this));
            });

            var nameField = $('#name');
            var slugField = $('#slug');

            function removeErrorMessages(inputField) {
                var parent = inputField.closest('.form-group');
                var errorElement = parent.find('.error');
                errorElement.remove();
                inputField.removeClass('is-invalid');
            }

            nameField.on('input', function() {
                var category_name = nameField.val();
                var str = category_name;
                str = str.toLowerCase().replace(/\s+/g, '-');
                str = str.replace(/[^a-z0-9-]/g, '');
                slugField.val(str);
                removeErrorMessages(slugField);
            });

            slugField.on('input', function() {
                removeErrorMessages(slugField);
            });
            $("#summernote").summernote({
                height: 300,
                focus: true,
            });

            if ($('#summernote').hasClass('is-invalid')) {
                $('#summernote').next('.note-editor').css('border-color', 'red');
            }

            $('#summernote').on('summernote.change', function(we, contents, $editable) {
                resetSummernoteBorder();
            });

            function resetSummernoteBorder() {
                $('#summernote').removeClass('is-invalid');
                $('#summernote').next('.note-editor').css('border-color', '');
            }

        });
    </script>
@endpush
