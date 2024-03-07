@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Country</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Country</a></li>
                        <li class="breadcrumb-item active">Edit Country</li>
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
                            <h3 class="card-title">Edit Country</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('countries.update', $country->id) }}"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $country->name }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Country Code</label>
                                    <input type="text" class="form-control @error('country_code') is-invalid @enderror"
                                        name="country_code" value="{{ $country->country_code }}">
                                    @error('country_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror"
                                            name="description" value="{{ $country->description }}">
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Iso3</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('iso3') is-invalid @enderror"
                                            name="iso3" value="{{ $country->iso3 }}">
                                        @error('iso3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Currency</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control @error('currency') is-invalid @enderror"
                                            name="currency" value="{{ $country->currency }}">
                                        @error('currency')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Currency Symbol</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('currency_symbol') is-invalid @enderror"
                                            name="currency_symbol" value="{{ $country->currency_symbol }}">
                                        @error('currency_symbol')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Currency Symbol Html</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('currency_symbol_html') is-invalid @enderror"
                                            name="currency_symbol_html" value="{{ $country->currency_symbol_html }}">
                                        @error('currency_symbol_html')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Currency Title</label>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control @error('currency_title') is-invalid @enderror"
                                            name="currency_title" value="{{ $country->currency_title }}">
                                        @error('currency_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="icon">Flag Image</label>
                                    <div class="input-group">
                                        <div class="col-md-6">
                                            <input type="file"
                                                class="form-control @error('flagimage') is-invalid @enderror"
                                                id="flag_image" name="flag_image">
                                        </div>
                                        @if ($country->flagimage)
                                            <div class="col-md-3">
                                                <img src="{{ asset($country->flagimage) }}" alt="Current feature image 1"
                                                    class="img-thumbnail" height="50" width="50" id="fimg1">
                                                <i class="fas fa-trash text-danger" id="removeflagimage"
                                                    onClick="removeflagimage()"></i>
                                                <input type="hidden"id="removeflagimages" name="removeflagimages" value>
                                                <i class="fas fa-undo text-danger" id="undoremovefimage"
                                                    onClick="undoflagimage()" style="display: none";></i>
                                            </div>
                                            @error('flagimage')
                                                <span class="error invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch"
                                            name="is_popular" {{ $country->is_popular ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch">Popular</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                            name="is_active" {{ $country->is_active ? 'checked' : '' }}>
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
                                @foreach ($country->logActivities as $activity)
                                    <div class="time-label">
                                        <span class="bg-red">{{ $activity->created_at->format('d-M-Y h:i A') }}</span>
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
    </section>
@endsection
@push('child-scripts')
    <script>
        function removeflagimage() {
            $('#removeflagimages').val('removed');
            $('#fimg1').attr('src', '{{ asset('images/countryimage/no-image.png') }}');
            $('#removeflagimage').hide();
            $('#undoremovefimage').show();
        }

        function undoflagimage() {
            $('#removeflagimages').val(null);
            $('#fimg1').attr('src', '{{ asset($country->flagimage) }}');
            $('#undoremovefimage').hide(); // hide the undo button
            $('#removeflagimage').show(); // show the remove button
        }
    </script>
@endpush
