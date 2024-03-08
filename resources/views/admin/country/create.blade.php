@extends('admin.layouts.app')
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
                        <li class="breadcrumb-item"><a href="{{ route('countries.index') }}">Country</a></li>
                        <li class="breadcrumb-item active">Create Country</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Country</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('countries.store') }}" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input id="country_name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" />
                                    @error('name')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Country Code<span class="text-danger">*</span></label>
                                    <input type="text" id="country_code"
                                        class="form-control @error('countrycode') is-invalid @enderror" name="countrycode"
                                        value="{{ old('countrycode') }}" />
                                    @error('countrycode')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description<span class="text-danger">*</span></label>
                                    <input id="descriptions" type="text"
                                        class="form-control @error('description') is-invalid @enderror" name="description"
                                        value="{{ old('description') }}" />
                                    @error('description')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Iso3<span class="text-danger">*</span></label>
                                    <input id="iso" type="text"
                                        class="form-control @error('iso3') is-invalid @enderror" name="iso3"
                                        value="{{ old('iso3') }}" />
                                    @error('iso3')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Currency<span class="text-danger">*</span></label>
                                    <input id="currencies" type="text"
                                        class="form-control @error('currency') is-invalid @enderror" name="currency"
                                        value="{{ old('currency') }}" />
                                    @error('currency')
                                        <span class="error invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Currency Symbol<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="currenciessymbol" type="text"
                                            class="form-control @error('currency_symbol') is-invalid @enderror"
                                            name="currency_symbol" value="{{ old('currency_symbol') }}" />
                                        @error('currency_symbol')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Currency Symbol Html<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="currenciessymbolhtml" type="text"
                                            class="form-control @error('currency_symbol_html') is-invalid @enderror"
                                            name="currency_symbol_html" value="{{ old('currency_symbol_html') }}" />
                                        @error('currency_symbol_html')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Currency Title<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="currencytitle" type="text"
                                            class="form-control @error('currency_title') is-invalid @enderror"
                                            name="currency_title" value="{{ old('currency_title') }}" />
                                        @error('currency_title')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Flag image<span class="text-danger">*</span></label>
                                    <input id="flag_images" type="file"
                                        class="form-control @error('flagimage') is-invalid @enderror" name="flagimage"
                                        value="{{ old('flagimage') }}" />
                                    @error('flagimage')
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
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch2"
                                            name="is_active" checked />
                                        <label class="custom-control-label" for="customSwitch2">Active</label>
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
@endsection
@push('child-scripts')
    <script>
        $(document).ready(function() {
            $("#country_name,#country_code,#descriptions,#iso,#currencies,#currenciessymbol,#currenciessymbolhtml,#currencytitle,#flag_images")
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
