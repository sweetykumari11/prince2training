@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Permissions</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permission</a></li>
                            <li class="breadcrumb-item active">Edit Permission</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Permission</h3>
                            </div>
                            <!-- /.card-header -->
                            <form method="POST" action="{{ route('permission.update', $permission->id) }}">
                                <div class="card-body">
                                    @csrf
                                    @method('PUT') <!-- Use the PUT method for updating -->
                                    <div class="form-group">
                                        <label for="category_id">Module Name<span class="text-danger">*</label>
                                        <select class="form-control select2bs4 @error('module_id') is-invalid @enderror"
                                            id="module_id" name="module_id">
                                            <option value="">--Select a Module--</option>
                                            @foreach ($modules as $module)
                                                <option value="{{ $module->id }}"
                                                    {{ $permission->module_id == $module->id ? 'selected' : '' }}>
                                                    {{ $module->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('module_id')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @php
                                        $permissionNameParts = explode('-', $permission->name);
                                        $selectedValue = end($permissionNameParts);
                                    @endphp
                                    <div class="form-group">
                                        <label for="category_id">Access<span class="text-danger">*</label>
                                        <select class="form-control select2bs4 @error('access') is-invalid @enderror"
                                            id="access" name="access">
                                            <option value="Insert" {{ $selectedValue === 'insert' ? 'selected' : '' }}>
                                                Insert</option>
                                            <option value="Update" {{ $selectedValue === 'update' ? 'selected' : '' }}>
                                            Update</option>
                                            <option value="Delete" {{ $selectedValue === 'delete' ? 'selected' : '' }}>
                                            Delete</option>
                                            <option value="List" {{ $selectedValue === 'list' ? 'selected' : '' }}>View
                                            </option>
                                        </select>
                                        @error('access')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description </label>
                                        <input type="text"
                                            class="form-control @error('description') is-invalid @enderror" id="description"
                                            value="{{ $permission->description }}" placeholder="Enter description"
                                            name="description">
                                        @error('description')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                                name="is_active" {{ $permission->is_active == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch1">Active</label>
                                        </div>
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
        </section>
    </div>
@endsection
