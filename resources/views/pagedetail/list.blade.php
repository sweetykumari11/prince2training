@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Home page</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Home Page</a></li>
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
                                <h3 class="card-title">Home Page</h3>
                                <div class="float-right"> <a class="btn btn-block btn-sm btn-success"
                                        href="{{ route('pagedetail.create') }}"> Create
                                        New Record</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Page Name</th>
                                                <th scope="col">Section</th>
                                                <th scope="col">Sub Section</th>
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
                                                ajax: '{{ route('pagedetail.index') }}',

                                                columns: [{
                                                        data: 'pagename',
                                                        name: 'pagename'
                                                    },
                                                    {
                                                        data: 'section',
                                                        name: 'section'
                                                    },
                                                    {
                                                        data: 'subsection',
                                                        name: 'subsection'
                                                    },
                                                    {
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('pagedetail.edit', ':id') }}'.replace(':id',
                                                                data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl = '{{ route('pagedetail.destroy', ':id') }}'.replace(
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
{{-- @push('child-scripts')
    <script>
        $(document).ready(function() {
            $('#table').on('click', '.is_active', function() {
                var activestatus = $(this).data('activestatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                var url = '/changeblogStatus';
                handleStatusToggle($toggle, activestatus, dataVal, url);
            });
             $('#table').on('click', '.is_popular', function() {
                var popularstatus = $(this).data('popularstatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                var url = '/blogsetpopular';
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
                            $('#danger-message').text(data.success).hide();
                        } else {
                            $toggle.removeClass('text-primary').addClass('text-secondary');
                            $toggle.data('popularstatus', 1);
                            $('#danger-message').text(data.success).show();
                            $('#success-message').text(data.success).hide();
                        }
                    }
                });
            });
            $(document).on('click', '.country-checkbox', function() {
                var blogId = $(this).data('blog-id');
                var isChecked = $(this).prop('checked');
                var url = '/blog-country';
                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    url: url,
                    data: {
                        'id': blogId,
                        'checked': isChecked
                    },
                    success: function(data) {
                        $checkbox.prop('checked', data.deleted_at === null);
                    }
                });
            });
        });
    </script>
@endpush --}}
