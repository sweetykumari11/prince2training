@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Activity Log List</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
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
                                <h3 class="card-title">Activity Log List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">User</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Module Type</th>
                                                <th scope="col">Date</th>
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
                                                ajax: '{{ route('actvities.index') }}',

                                                columns: [

                                                    {
                                                        data: 'creator.name',
                                                        name: 'creator.name',
                                                        orderable: false,
                                                        render: function(data, type, full, meta) {

                                                            if (full.creator) {
                                                                return full.creator.name;
                                                            } else {
                                                                return '';
                                                            }
                                                        }
                                                    },
                                                    {
                                                        data: 'activity',
                                                        name: 'activity'
                                                    },
                                                    {
                                                        data: 'module_type',
                                                        name: 'module_type',
                                                        render: function(data, type, full, meta) {
                                                            return data.replace(/^App\\Models\\/, '');
                                                        }
                                                    },
                                                    {
                                                        data: 'updated_at',
                                                        name: 'updated_at'
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
