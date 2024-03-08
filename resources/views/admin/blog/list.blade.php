@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Blogs</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blog</a></li>
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
                                <h3 class="card-title">Blog</h3>
                                <div class="float-right"> <a class="btn btn-block btn-sm btn-success"
                                        href="{{ route('blogs.create') }}"> Create
                                        New Blog</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Author Name</th>
                                                <th scope="col">Popular</th>
                                                <th scope="col">Active</th>
                                                <th scope="col">Country Active</th>
                                                <th scope="col">Country Popular</th>
                                                <th scope="col">Blog Detils</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Created At</th>
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
                                                ajax: '{{ route('blogs.index') }}',

                                                columns: [{
                                                        data: 'id',
                                                        name: 'id'
                                                    },
                                                    {
                                                        data: 'category_name',
                                                        name: 'category_name'
                                                    },
                                                    {
                                                        data: 'title',
                                                        name: 'title'
                                                    },
                                                    {
                                                        data: 'author_name',
                                                        name: 'author_name'
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
                                                        data: 'country',
                                                        name: 'country',
                                                        render: function(data, type, full, meta) {
                                                            var isChecked = full.countries.some(function(country) {
                                                                if (country.pivot.deleted_at == null) {
                                                                    return true;
                                                                } else {
                                                                    return false;
                                                                }
                                                            });
                                                            return '<input type="checkbox" class="country-checkbox" data-blog-id="' +
                                                                full.id + '" ' +
                                                                (isChecked ? 'checked' : '') + '>';
                                                        }
                                                    },
                                                    {
                                                        data: 'is_popular',
                                                        name: 'is_popular',
                                                        render: function(data, type, full, meta) {
                                                            if (data) {
                                                                return '<i class="fas fa-toggle-on text-primary"></i>';
                                                            } else {
                                                                return '<i class="fas fa-toggle-on text-secondary"></i>';
                                                            }
                                                        }
                                                    },
                                                    {

                                                        data: 'id',
                                                        name: 'faq',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('blogs.blogDetail.index', ':id') }}'.replace(
                                                                ':id', data);
                                                            var action = '<a href="' + editUrl +
                                                                '" class="fas fa-list text-primary"></a>';
                                                            return action;
                                                        }
                                                    },
                                                    {
                                                        data: 'creator.name',
                                                        name: 'creator.name'
                                                    },
                                                    {
                                                        data: 'created_at',
                                                        name: 'created_at',
                                                        render: function(data, type, full, meta) {
                                                            if (data) {
                                                                return moment(data).format('DD MMM YYYY [at] HH:mm:ss [GMT]');
                                                            }
                                                            return '';
                                                        }
                                                    },
                                                    {
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('blogs.edit', ':id') }}'.replace(':id', data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl = '{{ route('blogs.destroy', ':id') }}'.replace(':id',
                                                                data);

                                                            @php
                                                                $isAdmin = in_array('Admin', array_column(Auth::user()->roles->toArray(), 'name'));
                                                            @endphp

                                                            var action = '<a href="' + editUrl + '" class="fas fa-edit"></a>';

                                                            // if (@json($isAdmin)) {
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
                                                            //}
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
                var url = '/changeblogStatus';
                handleStatusToggle($toggle, activestatus, dataVal, url);
            });
            $('#table').on('click', '.is_popular', function() {
                var popularstatus = $(this).data('popularstatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                //alert('ndkvndfkgnkdf');
                var url = '/blogsetpopular';
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    data: {
                        'is_popular': popularstatus,
                        'id': dataVal
                    },
                    //alert('suvcess');
                    success: function(data) {
                        alert('suvcee');
                        if (popularstatus === 1) {
                            $toggle.removeClass('text-secondary').addClass('text-primary');
                            $toggle.data('popularstatus', 0);
                            $('#success-message').text(data.success).show();
                            $('#danger-message').text(data.success).hide();
                        } else {
                            alert('suvcee');
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
