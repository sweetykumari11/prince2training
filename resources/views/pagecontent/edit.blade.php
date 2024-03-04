@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Page Content Form</h1>
                    </div>
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('pagecontent.index') }}">Page Content Form</a></li>
                            <li class="breadcrumb-item active">Edit Pagecontent</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Pagecontent</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('pagecontent.update', $pagecontent->id) }}"
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                @method('PUT')
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Page Name<span class="text-danger">*</span></label>
                                        <input type="text" id="page_name"
                                            class="form-control @error('page_name') is-invalid @enderror" name="page_name"
                                            value="{{ $pagecontent->page_name }}">
                                        @error('page_name')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Section<span class="text-danger">*</span></label>
                                        <input type="text" id="sections"
                                            class="form-control @error('section') is-invalid @enderror" name="section"
                                            value="{{ $pagecontent->section }}">
                                        @error('section')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Sub Section<span class="text-danger">*</span></label>
                                        <input type="text" id="subsections"
                                            class="form-control @error('subsection') is-invalid @enderror" name="subsection"
                                            value="{{ $pagecontent->sub_section }}">
                                        @error('subsection')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Heading<span class="text-danger">*</span></label>
                                        <input type="text" id="headings"
                                            class="form-control @error('heading') is-invalid @enderror" name="heading"
                                            value="{{ $pagecontent->heading }}">
                                        @error('Heading')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Content<span class="text-danger">*</span></label>
                                        <input type="text" id="contents"
                                            class="form-control @error('content') is-invalid @enderror" name="content"
                                            value="{{ $pagecontent->content }}">
                                        @error('content')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Page Tag Line<span class="text-danger">*</span></label>
                                        <input type="text" id="pagetaglines"
                                            class="form-control @error('pagetagline') is-invalid @enderror"
                                            name="pagetagline" value="{{ $pagecontent->page_tag_line }}">
                                        @error('pagetagline')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="col-md-6">
                                                <input type="file"
                                                    class="form-control @error('image') is-invalid @enderror" id="image"
                                                    name="image">
                                            </div>
                                            @if ($pagecontent->image)
                                                <div class="col-md-3">
                                                    <img src="{{ asset($pagecontent->image) }}" alt="Current Image"
                                                        class="img-thumbnail" height="50" width="50"
                                                        id="currentImage">
                                                    <i class="fas fa-trash text-danger" id="removeImage"
                                                        onClick="removeImage()"></i>
                                                    <input type="hidden" id="removeImageTxt" name="removeImageTxt" value>
                                                    <i class="fas fa-undo text-danger" id="undoRemoveImage"
                                                        onClick="undoRemoveImage()" style="display: none;"></i>
                                                </div>
                                            @endif
                                            @error('image')
                                                <span class="error invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Image Alt<span class="text-danger">*</span></label>
                                        <input type="text" id="imagealts"
                                            class="form-control @error('image_alt') is-invalid @enderror" name="image_alt"
                                            value="{{ $pagecontent->image_alt }}">
                                        @error('image_alt')
                                            <span class="error invaliSd-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="icons">Icon<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="col-md-6">
                                                <input type="file"
                                                    class="form-control @error('icon') is-invalid @enderror"
                                                    id="icons" name="icon">
                                            </div>
                                            @if ($pagecontent->icon)
                                                <div class="col-md-3">
                                                    <img src="{{ asset($pagecontent->icon) }}" alt="Current Icon"
                                                        class="img-thumbnail" height="50" width="50"
                                                        id="cIcon">
                                                    <i class="fas fa-trash text-danger" id="removeicon"
                                                        onClick="removeIcon()"></i>
                                                    <input type="hidden" id="removeicontxt" name="removeicontxt" value>
                                                    <i class="fas fa-undo text-danger" id="undoremoceicon"
                                                        onClick="undoIcon()" style="display: none;"></i>
                                                </div>
                                            @endif
                                            @error('icon')
                                                <span class="error invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label>Icon Alt<span class="text-danger">*</span></label>
                                        <input type="text" id="iconalts"
                                            class="form-control @error('iconalt') is-invalid @enderror" name="icon_alt"
                                            value="{{ $pagecontent->icon_alt }}">
                                        @error('iconalt')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Heading Content 1</label>
                                        <input type="text"
                                            class="form-control @error('headingcontent1') is-invalid @enderror"
                                            name="headingcontent1" value="{{ $pagecontent->heading_content1 }}">
                                        @error('headingcontent1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Subcontent 1<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('headingsubcontent1') is-invalid @enderror"
                                            name="headingsubcontent1" value="{{$pagecontent->heading_subcontent1}}">
                                        @error('headingsubcontent1')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Content 2<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('headingcontent2') is-invalid @enderror"
                                            name="headingcontent2"value="{{$pagecontent->heading_content2}}">
                                        @error('headingcontent2')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Subcontent 2<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('headingsubcontent2') is-invalid @enderror"
                                            name="headingsubcontent2" value="{{$pagecontent->heading_subcontent2}}">
                                        @error('headingsubcontent2')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Heading Content 3<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('headingcontent3') is-invalid @enderror"
                                            name="headingcontent3" value="{{$pagecontent->heading_content3}}">
                                        @error('headingcontent3')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Heading Subcontent 3 -->
                                    <div class="form-group">
                                        <label>Heading Subcontent 3<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('headingsubcontent3') is-invalid @enderror"
                                            name="headingsubcontent3" value="{{$pagecontent->heading_subcontent3}}">
                                        @error('headingsubcontent3')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Heading Content 4 -->
                                    <div class="form-group">
                                        <label>Heading Content 4<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('headingcontent4') is-invalid @enderror"
                                            name="headingcontent4" value="{{$pagecontent->heading_content4}}">
                                        @error('headingcontent4')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <!-- Heading Subcontent 4 -->
                                    <div class="form-group">
                                        <label>Heading Subcontent 4<span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control @error('headingsubcontent4') is-invalid @enderror"
                                            name="headingsubcontent4" value="{{$pagecontent->heading_subcontent4}}">
                                        @error('headingsubcontent4')
                                            <span class="error invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Activity</h3>
                    </div>
                    <div class="card-body">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->
                            @foreach ($pagecontent->logActivities as $activity)
                                <div class="time-label">
                                    <span class="bg-red">{{ $activity->created_at->format('d-M-Y h:i A') }}</span>
                                </div>
                                <div>
                                    <i class="fas fa-solid fa-pen bg-blue"></i>
                                    <div class="timeline-item">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ $activity->creator->name }}</h3>
                                        </div>
                                        <h3 class="timeline-header no-border"> {{ $activity->activity }} </a></h3>
                                    </div>
                                </div>
                            @endforeach
                            <div>
                                <i class="fas fa-clock bg-gray"></i>
                            </div>
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
            $("#pagenames,#sections,#subsections,#home_image")
                .on("input", function() {
                    removeErrorMessages($(this));
                });

            function removeErrorMessages(inputField) {
                var parent = inputField.closest('.form-group');
                var errorElement = parent.find('.error');
                errorElement.remove();
                inputField.removeClass('is-invalid');
            }
        });

        function removeImage() {
            $('#removeImageTxt').val('removed');
            $('#currentImage').attr('src', '{{ asset('Images/featureimage1/no-image.png') }}');
            $('#removeImage').hide();
            $('#undoRemoveImage').show();
        }

        function undoRemoveImage() {
            $('#removeImageTxt').val(null);
            $('#currentImage').attr('src', '{{ asset($pagecontent->image) }}');
            $('#removeImage').show();
            $('#undoRemoveImage').hide();
        }

        function removeIcon() {
            $('#removeicontxt').val('removed');
            $('#cIcon').attr('src', '{{ asset('Images/icon/no-image.png') }}');
            $('#removeicon').hide();
            $('#undoremoceicon').show();
        }

        function undoIcon() {
            $('#removeicontxt').val(null);
            $('#cIcon').attr('src', '{{ asset($pagecontent->icon) }}');
            $('#removeicon').show();
            $('#undoremoceicon').hide();
        }
    </script>
@endpush
