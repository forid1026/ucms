@extends('admin.layout.admin_master');
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- Flipbook StyleSheet -->
    <link href="{{ asset('backend/dflip/css/dflip.min.css') }} " rel="stylesheet" type="text/css">
    <!-- Icons Stylesheet -->
    <link href="{{ asset('backend/dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Notice</h3>
                        </div>
                        <!-- form start -->
                        <form id="basicForm" action="{{ route('update.notice') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $noticeInfo->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" id="title" required
                                        required data-parsley-pattern="[a-zA-Z ]+$" data-parsley-trigger="keyup"
                                        data-parsley-required-message="Title is required."
                                        data-parsley-pattern-message="Title Must Be Alphabet."
                                        value="{{ $noticeInfo->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="semester_id">Semester Name</label>
                                    <select class="form-control" name="semester_id" id="semester_id">
                                        <option selected disabled>Select Semester</option>
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}"
                                                {{ $semester->id == $noticeInfo->semester_id ? 'selected' : '' }}>
                                                {{ $semester->semester_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="section_id">Section Name</label>
                                    <select class="form-control" name="section_id" id="section_id">
                                        <option selected disabled>Select Semester</option>
                                        @foreach ($sections as $section)
                                            <option value="{{ $section->id }}"
                                                {{ $section->id == $noticeInfo->section_id ? 'selected' : '' }}>
                                                {{ $section->section_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="editor" name="description" placeholder="Notice Description">
                                        {{ $noticeInfo->description }}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="notice_file">Notice FIle</label>
                                    <input type="file" name="notice_file" class="form-control" id="notice_file"
                                        value="{{ $noticeInfo->notice_file }}">
                                </div>
                                <div class="form-group">
                                    <div class="_df_thumb" id="df_manual_thumb" height="100%"
                                        source="{{ asset(!empty($noticeInfo->notice_file) ? url($noticeInfo->notice_file) : url('upload/thumbnail.jpg')) }}"
                                        thumb="{{ asset('upload/thumbnail.jpg') }}"> View Pdf</div>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update Notice</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script>
        $('#basicForm').parsley();
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- Flipbook main Js file -->
    <script src="{{ asset('backend/dflip/js/dflip.min.js') }}" type="text/javascript"></script>

    {{-- get section name --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#semester_id').on('change', function() {
                let semesterId = $(this).val();
                console.log(semesterId);
                $.ajax({
                    url: '{{ route('get.section') }}?semester_id=' + semesterId,
                    type: 'GET',
                    success: function(data) {
                        console.log('data', data);
                        let html = '<option value="">Select Section </option>';
                        $.each(data, function(key, value) {
                            console.log(value);
                            html += '<option value=" ' + value.section_name + ' "> ' +
                                value.section_name + '</option>';
                        });
                        $("#section_id").html(html);
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
