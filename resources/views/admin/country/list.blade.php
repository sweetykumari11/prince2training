@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Country</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="{{ route('countries.index') }}">Country</a></li>
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
                                <h3 class="card-title">Country</h3>
                                <div class="float-right"> <a class="btn btn-block btn-sm btn-success"
                                        href="{{ route('countries.create') }}">
                                        Create New Country</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Country Code</th>
                                                <th scope="col">Currency</th>
                                                <th scope="col">Active</th>
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
                                                ajax: '{{ route('countries.index') }}',
                                                columns: [{
                                                        data: 'id',
                                                        name: 'id'
                                                    },
                                                    {
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'country_code',
                                                        name: 'country_code'
                                                    },
                                                    {
                                                        data: 'currency',
                                                        name: 'currency'
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
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('countries.edit', ':id') }}'.replace(':id',
                                                                data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl = '{{ route('countries.destroy', ':id') }}'.replace(':id',
                                                                data);

                                                            var action = '<a href="' + editUrl + '" class="fas fa-edit"></a>';


                                                            action += '<a href="#" class="delete-link" ' +
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
{{-- @push('child-scripts')
    <script>
        $(document).ready(function() {
            $('#table').on('click', '.is_active', function() {

                var activestatus = $(this).data('activestatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                var url = '/changecountryStatus';
                handleStatusToggle($toggle, activestatus, dataVal, url);
            });


        });
    </script>
@endpush --}}
