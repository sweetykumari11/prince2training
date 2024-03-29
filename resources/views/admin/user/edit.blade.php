@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>User</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit User</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('user.update', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name<span class="text-danger">*</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            id="exampleInputEmail1" value="{{ $user->name }}" placeholder="Enter Name"
                                            name="name">
                                        @error('name')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email <span class="text-danger">*</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror"
                                            id="exampleInputEmail1" value="{{ $user->email }}" placeholder="Enter Email"
                                            name="email">
                                        @error('email')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="is_active"
                                                id="customSwitch2" {{ $user->is_active == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customSwitch2">Active</label>
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
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <form method="POST" action="{{ route('user.rolesupdate', $user->id) }}">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="card-header">
                                    <h3 class="card-title">Assign Roles</h3>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        @foreach ($roles as $role)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input"
                                                    {{ $user->roles->contains('id', $role->id) ? 'checked' : '' }}
                                                    name="roles[]" type="checkbox" id=""
                                                    value="{{ $role->id }}" />
                                                <label class="form-check-label" for="">{{ $role->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Roles</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
