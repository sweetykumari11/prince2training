@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Location</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Location</a></li>
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
                                <h3 class="card-title">Location</h3>
                                <div class="float-right"> <a class="btn btn-block btn-sm btn-success"
                                        href="{{ route('locations.create') }}"> Create
                                        New Record</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Country</th>
                                                <th scope="col">Popular</th>
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
                                                ajax: '{{ route('locations.index') }}',

                                                columns: [{
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'country.name',
                                                        name: 'country.name',
                                                    },
                                                    {
                                                        data: 'is_popular',
                                                        name: 'is_popular',
                                                        render: function(data, type, full, meta) {
                                                            if (data) {
                                                                return '<i class="fa fa-check-circle text-success is_popular" data-popularstatus="1" data-val="' +
                                                                    full.id + '"></i>';
                                                            } else {
                                                                return '<i class="fa fa-times-circle text-danger is_popular" data-popularstatus="0" data-val="' +
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
                                                            var editUrl = '{{ route('locations.edit', ':id') }}'.replace(':id',
                                                                data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl = '{{ route('locations.destroy', ':id') }}'.replace(
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
@push('child-scripts')
    <script>
        $('#table').on('click', '.is_popular', function() {
            var popularstatus = $(this).data('popularstatus');
            var dataVal = $(this).data('val');
            var $toggle = $(this);
            var url = '/locations/setpopular'; // Update the URL to match your route

            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                data: {
                    'is_popular': popularstatus,
                    'id': dataVal
                },
                success: function(data) {
                    if (popularstatus === 1) {
                        $toggle.removeClass('text-secondary').addClass('text-primary');
                        $toggle.data('popularstatus', 0);
                        $('#success-message').text(data.success).show();
                        $('#danger-message').text('').hide();
                    } else {
                        $toggle.removeClass('text-primary').addClass('text-secondary');
                        $toggle.data('popularstatus', 1);
                        $('#danger-message').text(data.success).show();
                        $('#success-message').text('').hide();
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
