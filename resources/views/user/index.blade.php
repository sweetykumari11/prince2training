@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Users</a></li>
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
                                <h3 class="card-title">User list</h3>
                                <div class="float-right">
                                    <a class="btn btn-block btn-sm btn-success" href="{{ route('user.create') }}"> Create
                                        New User</a>
                                </div>
                                <div class="float-right mr-3">
                                    <select id="statusFilter" class="form-control">
                                        <option value="all">All</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="float-right mr-3">
                                    <select id="roleFilter" class="form-control">
                                        <option value="">All Roles</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Roles</th>
                                                <th scope="col">Active</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                @push('child-scripts')
                                    <script>
                                        $(function() {
                                            var table = $('#table').DataTable({
                                                processing: true,
                                                serverSide: true,
                                                ajax: {
                                                    url: '{{ route('user.index') }}',
                                                    data: function(d) {
                                                        d.status = $('#statusFilter').val();
                                                        d.role_name = $('#roleFilter').val();
                                                    }
                                                },
                                                columns: [{
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'email',
                                                        name: 'email'
                                                    },
                                                    {
                                                        data: 'roles',
                                                        name: 'roles',
                                                        render: function(data, type, full, meta) {
                                                            return data.map(role => role.name).join(', ');
                                                        }
                                                    },
                                                    {
                                                        data: 'is_active',
                                                        name: 'is_active',
                                                        render: function(data, type, full, meta) {
                                                            if (data) {
                                                                return '<i class="fa fa-check-circle text-success is_active" data-activestatus="1" data-val="' +
                                                                    full.id + '"></i>';
                                                            } else {
                                                                return '<i class="fa fa-times-circle text-danger is_active" data-activestatus="0" data-val="' +
                                                                    full.id + '"></i>';
                                                            }
                                                        }
                                                    },
                                                    {
                                                        data: 'password',
                                                        name: 'password',
                                                        render: function(data, type, full, meta) {
                                                            return '<a href="/password/reset/' + full.id +
                                                                '" id="password-reset-link-' + full.id +
                                                                '" class="btn btn-primary btn-sm">Reset</a>';
                                                        }
                                                    },
                                                    {
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('user.edit', ':id') }}'.replace(':id', data);
                                                            return '<a href="' + editUrl + '" class="fas fa-edit"></a>';
                                                        }
                                                    },
                                                ]
                                            });

                                            $('#statusFilter, #roleFilter').on('change', function() {
                                                var status = $('#statusFilter').val();
                                                var roleName = $('#roleFilter').val();
                                                var url = '{{ route('user.index') }}';

                                                // Append status to URL
                                                url += '?status=' + status;

                                                // Append role name to URL if it's not empty
                                                if (roleName) {
                                                    url += '&role_name=' + roleName;
                                                }

                                                // Reload the DataTable with the new filters
                                                table.ajax.url(url).load();
                                            });
                                        });
                                    </script>
                                @endpush
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
