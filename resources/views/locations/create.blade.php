@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Location</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('locations.index') }}">Location</a></li>
                            <li class="breadcrumb-item active">Create Location</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            {{-- @if ($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Location</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('locations.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInput1">Name<span class="text-danger">*</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="location_name" name="name" placeholder="Enter name">
                                        @error('name')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select id="location_country" name="country_id"
                                            class="form-control select2bs4 @error('country_id') is-invalid @enderror">
                                            <option value="">--Select a Country--</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Region<span class="text-danger">*</span></label>
                                        <select id="location_region" name="region_id"
                                            class="form-control select2bs4 @error('region_id') is-invalid @enderror">
                                            <option value="">--Select a Region--</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('region_id')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Address<span class="text-danger">*</span></label>
                                        <input id="location_address" type="text"
                                            class="form-control @error('address') is-invalid @enderror" name="address"
                                            value="{{ old('address') }}" />
                                        @error('address')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Slug<span class="text-danger">*</span></label>
                                        <input type="text" id="location_slug"
                                            class="form-control @error('slug') is-invalid @enderror" name="slug"
                                            value="{{ old('slug') }}" />
                                        @error('slug')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="location_phone">Phone<span class="text-danger">*</span></label>
                                        <input type="text" id="location_phone"
                                            class="form-control @error('phone') is-invalid @enderror" name="phone"
                                            value="{{ old('phone') }}" />
                                        @error('phone')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Intro<span class="text-danger">*</span></label>
                                        <input id="location_intro" type="text"
                                            class="form-control @error('intro') is-invalid @enderror" name="intro"
                                            value="{{ old('intro') }}" />
                                        @error('intro')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Image<span class="text-danger">*</span></label>
                                        <input id="location_image" type="file"
                                            class="form-control @error('image') is-invalid @enderror" name="image"
                                            value="{{ old('image') }}" />
                                        @error('image')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="location_image" name="image">
                                        </div>
                                        @error('image')
                                            <span class="error invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Description <span class="text-danger">*</span></label>
                                        <textarea id="summernote" class="summernote @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Title<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('meta_title') is-invalid @enderror"
                                            id="location_meta_title" name="meta_title" placeholder="Enter title"
                                            value="{{ old('meta_title') }}">

                                        @error('meta_title')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Keywords<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('meta_keywords') is-invalid @enderror"
                                            id="location_meta_keywords" name="meta_keywords" placeholder="Enter keywords"
                                            value="{{ old('meta_keywords') }}">

                                        @error('meta_keywords')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Meta Description<span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('meta_description') is-invalid @enderror"
                                            id="location_meta_description" name="meta_description"
                                            placeholder="Enter description" value="{{ old('meta_description') }}">

                                        @error('meta_description')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                                name="is_popular" />
                                            <label class="custom-control-label" for="customSwitch1">Popular</label>
                                        </div>
                                    </div>

                                    <div class="container-fluid">
                                        <div id="map" style="height: 400px;"></div>

                                        <input type="hidden" name="latitude" id="latitude" value="51.5">
                                        <input type="hidden" name="longitude" id="longitude" value="-0.09">

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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script>
        $(document).ready(function() {

            $('#location_name, #location_country, #location_region, #location_address, #location_slug, #location_phone, #location_intro, #location_image, #location_latitude, #location_longitude, #location_description, #location_meta_title, #location_meta_description, #location_meta_keywords')
                .on('input', function() {
                    removeErrorMessages($(this));
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

            var nameField = $('#location_name');
            var slugField = $('#location_slug');

            function removeErrorMessages(inputField) {
                var parent = inputField.closest('.form-group');
                var errorElement = parent.find('.error');
                errorElement.remove();
                inputField.removeClass('is-invalid');
            }

            nameField.on('input', function() {
                var location_name = nameField.val();
                var str = location_name;
                str = str.toLowerCase().replace(/\s+/g, '-');
                str = str.replace(/[^a-z0-9-]/g, '');
                slugField.val(str);
                removeErrorMessages(slugField);
            });

            slugField.on('input', function() {
                removeErrorMessages(slugField);
            });

            var latitude = 51.5;
            var longitude = -0.09;

            var map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Your Location')
                .openPopup();

            // Set hidden input field values
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
        });
    </script>
@endpush
