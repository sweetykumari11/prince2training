@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Course</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Course</a></li>
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
                                <h3 class="card-title">Course list</h3>
                                <div class="float-right"> <a class="btn btn-block btn-sm btn-success"
                                        href="{{ route('course.create') }}"> Create New Course</a></div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Id</th>
                                                <th scope="col">Course Name</th>
                                                <th scope="col">Topic Name</th>
                                                <th scope="col">Active</th>
                                                <th scope="col">Country Active</th>
                                                <th scope="col">Country Popular</th>
                                                <th scope="col">Detail</th>
                                                <th scope="col">FaQ</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Created By</th>
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
                                                ajax: '{{ route('course.index') }}',
                                                columns: [{
                                                        data: 'id',
                                                        name: 'id'
                                                    },
                                                    {
                                                        data: 'name',
                                                        name: 'name'
                                                    },
                                                    {
                                                        data: 'topic.name',
                                                        name: 'topic.name'
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
                                                        data: 'isactive',
                                                        name: 'isactive',
                                                        render: function(data, type, full, meta) {
                                                            var isChecked = full.countries.some(function(country) {
                                                                if (country.pivot.deleted_at == null) {
                                                                    return true;
                                                                } else {
                                                                    return false;
                                                                }
                                                            });

                                                            return '<input type="checkbox" class="course-checkbox" data-course-id="' +
                                                                full.id + '" ' +
                                                                (isChecked ? 'checked' : '') + '>';
                                                        }
                                                    },
                                                    {
                                                        data: 'popular',
                                                        name: 'popular',
                                                        render: function(data, type, full, meta) {
                                                            var ispopular = full.countries.some(function(country) {
                                                                return country.pivot.is_popular;
                                                            });
                                                            if (ispopular == 1) {
                                                                return '<i class="fas fa-toggle-on text-primary is_popular" data-popularstatus="' +
                                                                    0 + '" data-val="' + full.id + '"></i>';
                                                            } else {
                                                                return '<i class="fas fa-toggle-on text-secondary is_popular" data-popularstatus="' +
                                                                    1 + '" data-val="' + full.id + '"></i>';
                                                            }
                                                        }
                                                    },

                                                    {
                                                        data: 'id',
                                                        name: 'detail',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('course.coursedetails.index', ':id') }}'
                                                                .replace(
                                                                    ':id',
                                                                    data);
                                                            var action = '<a href="' + editUrl +
                                                                '" class="fas fa-list text-primary"></a>';
                                                            return action;
                                                        }
                                                    },
                                                    {
                                                        data: 'id',
                                                        name: 'faq',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('course.faqs.index', ':id') }}'.replace(
                                                                ':id',
                                                                data);
                                                            var action = '<a href="' + editUrl +
                                                                '" class="fas fa-question-circle text-primary"></a>';
                                                            return action;
                                                        }
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
                                                        data: 'creator.name',
                                                        name: 'creator.name'
                                                    }, {
                                                        data: 'id',
                                                        name: 'actions',
                                                        orderable: false,
                                                        searchable: false,
                                                        render: function(data, type, full, meta) {
                                                            var editUrl = '{{ route('course.edit', ':id') }}'.replace(':id',
                                                                data);
                                                            var deleteFormId = 'delete-form-' + data;
                                                            var deleteUrl = '{{ route('course.destroy', ':id') }}'.replace(':id',
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

@push('child-scripts')
    <script>
        $(document).ready(function() {
            $('#table').on('click', '.is_active', function() {
                var activestatus = $(this).data('activestatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                var url = '/changecourseStatus';
                handleStatusToggle($toggle, activestatus, dataVal, url);
            });
            $('#table').on('click', '.is_popular', function() {
                var popularstatus = $(this).data('popularstatus');
                var dataVal = $(this).data('val');
                var $toggle = $(this);
                var url = '/coursesetpopular';
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
        });
        $(document).on('click', '.course-checkbox', function() {
            var course_id = $(this).data('course-id');
            var checked = $(this).prop('checked');
            var url = '/ActiveCourse';
            $.ajax({
                type: "GET",
                dataType: "json",
                url: url,
                data: {
                    'course_id': course_id,
                    'checked': checked
                },
                success: function(data) {
                    $(this).prop('checked', data.deleted_at === null);
                }
            });
        });
    </script>
@endpush
