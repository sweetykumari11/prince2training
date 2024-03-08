@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Topic Detail</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('topic.index') }}">Topic</a></li>
                            <li class="breadcrumb-item">Topic Detail</li>
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
                                <h3 class="card-title">Topic Detail list</h3>
                                <div class="float-right"> <a class="btn btn-block btn-sm btn-success"
                                        href="{{ route('topic.topicdetails.create', $id) }}">Create New Detail</a></div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Topic Name</th>
                                                <th scope="col">Country</th>
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
                                                ajax: '{{ route('topic.topicdetails.index', $id) }}',
                                                columns: [{
                                                        data: 'id',
                                                        name: 'id'
                                                    },
                                                    {
                                                        data: 'topic.name',
                                                        name: 'topic.name'
                                                    },
                                                    {
                                                        data: 'country.name',
                                                        name: 'country.name'
                                                    },
                                                    {
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('topic.topicdetails.edit', [$id, ':id']) }}'
                                                                .replace(':id',
                                                                    data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl =
                                                                '{{ route('topic.topicdetails.destroy', [$id, ':id']) }}'.replace(
                                                                    ':id',
                                                                    data);

                                                            var action = '<a href="' + editUrl + '" class="fas fa-edit"></a>';


                                                            action += '<a href="#" class="delete-link" ' +
                                                                'onclick="event.preventDefault(); document.getElementById(\'' +
                                                                deleteFormId + '\').submit();">' +
                                                                '<i class="fas fa-trash text-danger"></i>' +
                                                                '</a>' +
                                                                '<form id="' + deleteFormId + '" ' +
                                                                'action="' + deleteUrl +
                                                                '" method="POST" style="display: none;">' +
                                                                '@csrf' +
                                                                '@method('DELETE')' +
                                                                '</form>';

                                                            return action;
                                                        }
                                                    },
                                                ]
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
