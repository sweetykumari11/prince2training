@extends('layouts.app')
@section('content')
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
                        <li class="breadcrumb-item active">Edit Location</li>
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
                            <h3 class="card-title">Edit Location</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('locations.update', $location->id) }}"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                @method('PUT')
                                <div class="form-group">
                                    <label for="exampleInput1">Name<span class="text-danger">*</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter name"
                                        value="{{ $location->name }}">
                                    @error('name')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="region_country">Country<span class="text-danger">*</span></label>
                                    <select id="region_country" name="country_id"
                                        class="form-control select2bs4 @error('country_id') is-invalid @enderror">
                                        <option value="">Select a Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                {{ $location->country_id == $country->id ? 'selected' : '' }}>
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
                                    <label for="region">Region<span class="text-danger">*</span></label>
                                    <select id="region" name="region_id"
                                        class="form-control select2bs4 @error('region_id') is-invalid @enderror">
                                        <option value="">Select a Region</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->id }}"
                                                {{ $location->region_id == $region->id ? 'selected' : '' }}>
                                                {{ $region->name }}</option>
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
                                    <input id="location_address" type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ $location->address }}" />
                                    @error('address')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
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
                                    <label for="location_phone">Phone<span class="text-danger">*</span></label>
                                    <input type="tel" id="location_phone"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ $location->phone }}" pattern="[0-9]{10}"
                                        title="Please enter a 10-digit number" maxlength="10" />
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
                                        value="{{ $location->intro }}" />
                                    @error('intro')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="location_image">Image<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="col-md-6">
                                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                                id="location_image" name="image">
                                        </div>
                                        @if ($location->image)
                                            <div class="col-md-3">
                                                <img src="{{ asset($location->image) }}" alt="Current Image"
                                                    class="img-thumbnail" height="50" width="50"
                                                    id="cLocationImage">
                                                <i class="fas fa-trash text-danger" id="removeLocationImage"
                                                    onClick="removeLocationImage()"></i>
                                                <input type="hidden" id="removeLocationImageTxt"
                                                    name="removeLocationImageTxt" value="">
                                                <i class="fas fa-undo text-danger" id="undoRemoveLocationImage"
                                                    onClick="undoLocationImage()" style="display: none;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    @error('image')
                                        <span class="error invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea id="summernote" class="summernote @error('description') is-invalid @enderror" name="description">{{ $location->description }}</textarea>
                                    @error('description')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Title<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                        id="location_meta_title" name="meta_title" placeholder="Enter title"
                                        value="{{ $location->meta_title }}">

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
                                        value="{{ $location->meta_keywords }}">
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
                                        placeholder="Enter description" value="{{ $location->meta_description }}">


                                    @error('meta_description')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch"
                                            name="is_popular" {{ $location->is_popular ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch">Popular</label>
                                    </div>
                                </div>

                                <div class="container-fluid">
                                    <div id="map" style="height: 400px;"></div>

                                    <input type="hidden" name="latitude" id="latitude" value="51.5">
                                    <input type="hidden" name="longitude" id="longitude" value="-0.09">
                                </div> <!-- Closing container-fluid -->

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
                                @foreach ($location->logActivities as $activity)
                                    <div class="time-label">
                                        <span class="bg-red">{{ $activity->created_at->format('d-M-Y h:i A') }}</span>
                                    </div>

                                    <div>
                                        <i class="fas fa-solid fa-pen bg-blue"></i>
                                        <div class="timeline-item">
                                            <div class="card-header">
                                                <h3 class="card-title">
                                                    @if ($activity->created_by)
                                                        {{ $activity->creator->name }}
                                                    @else
                                                        System
                                                    @endif
                                                </h3>
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
    </div> <!-- Closing content-wrapper -->
@endsection

@push('child-scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script>
        $(document).ready(function() {
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
    <script>
        function removeLocationImage() {
            $('#removeLocationImageTxt').val('removed');
            $('#cLocationImage').attr('src', '{{ asset('Images/location/no-image.png') }}');
            $('#removeLocationImage').hide();
            $('#undoRemoveLocationImage').show();
        }

        function undoLocationImage() {
            $('#removeLocationImageTxt').val('');
            $('#cLocationImage').attr('src',
                '{{ asset($location->image) }}'); // Assuming $location->image contains the original image path
            $('#removeLocationImage').show();
            $('#undoRemoveLocationImage').hide();
        }
    </script>
@endpush
