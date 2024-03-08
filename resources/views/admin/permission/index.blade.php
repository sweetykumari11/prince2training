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
                            <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Permissions</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        {{-- <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Permission</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">


                                <div class="form-group">
                                    <label for="category_id">Module Name</label>
                                    <select class="form-control" id="module_id" name="module_id">
                                        <option value="">All</option> <!-- Default empty option -->
                                        @foreach ($modules as $module)
                                            <option
                                                value="{{ $module->id }}"{{ old('module_id') == $module->id ? 'selected' : '' }}>
                                                {{ $module->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="category_id">Access</label>
                                    <select class="form-control select " id="access" name="access">
                                        <option value ="">All</option>
                                        <option value ="insert"{{ old('access') == 'insert' ? 'selected' : '' }}>insert
                                        </option>
                                        <option value ="update"{{ old('access') == 'update' ? 'selected' : '' }}>update
                                        </option>
                                        <option value ="delete"{{ old('access') == 'delete' ? 'selected' : '' }}>delete
                                        </option>
                                        <option value ="list"{{ old('access') == 'list' ? 'selected' : '' }}>view</option>
                                    </select>

                                </div>



                                <div class="card-footer">
                                    <button type="button" id="searchBtn" class="btn btn-primary">search</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Permissions </h3>
                                <div class="float-right"> <a class="btn btn-block btn-sm btn-success"
                                        href="{{ route('permission.create') }}"> Create New Permission</a>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Module Name</th>
                                                <th scope="col">Access</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                @push('child-scripts')
                                    <script>
                                        $(function() {
                                            $('#table').DataTable({
                                                processing: true,
                                                serverSide: true,
                                                ajax: {
                                                    url: '{{ route('permission.index') }}',
                                                    data: function(d) {
                                                        d.module_id = $('#module_id').val(); // Capture selected module_id
                                                        d.access = $('#access').val(); // Capture selected access
                                                    }
                                                },
                                                columns: [{
                                                        data: 'module_name',
                                                        name: 'module_name'
                                                    },
                                                    {
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'description',
                                                        name: 'description'
                                                    },
                                                    {
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('permission.edit', ':id') }}'.replace(':id',
                                                                data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl = '{{ route('permission.destroy', ':id') }}'.replace(
                                                                ':id',
                                                                data);

                                                            return '<a href="' + editUrl + '" class="fas fa-edit"></a>' +
                                                                '<a href="#" class="delete-link" ' +
                                                                '   onclick="event.preventDefault(); document.getElementById(\'' +
                                                                deleteFormId + '\').submit();">' +
                                                                '   <i class="fas fa-trash text-danger"></i>' +
                                                                '</a>' +
                                                                '<form id="' + deleteFormId + '" ' +
                                                                '   action="' + deleteUrl +
                                                                '" method="POST" style="display: none;">' +
                                                                '   @csrf' +
                                                                '   @method('DELETE')' +
                                                                '</form>';
                                                        }
                                                    },
                                                ]
                                            });
                                            // $('#access, #module_id').change(function() {
                                            //     $('#table').DataTable().ajax.reload();
                                            // });

                                            $('#searchBtn').click(function() {
                                                $('#table').DataTable().ajax.reload();
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
