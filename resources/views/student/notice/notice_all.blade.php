@extends('admin.layout.admin_master')
@section('student')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js                                                                            ">
    </script>
    <!-- Main content -->
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Notice Board</h3>
                        </div>
                        <div class="card-body">
                            @foreach ($studentNotice as $notice)
                                <div class="notice-section mb-5">
                                    <h4 class="">{{ $notice->title }}</h4>
                                    <div class="inner-div d-flex justify-content-between align-items-center">
                                        <p class="mb-0">Published Date:
                                            {{ date('d M, Y', strtotime($notice->created_ate)) }}
                                        </p>
                                        <a href="{{ route('student.notice.detail', $notice->id) }}"
                                            class="btn btn-outline-info mb-0"> <i class="fa fa-plus" aria-hidden="true">
                                                Read More</i></a>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
    <script>
        $('#basicForm').parsley();
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
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
                            html += '<option value=" ' + value.id + ' "> ' +
                                value.section_name + '</option>';
                        });
                        $("#section_id").html(html);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#notice_type', function() {
                let notice_type = $(this).val();
                if (notice_type == 'semester_wise') {
                    $('#semester_column').show();
                    $('#section_column').show();
                } else {
                    $('#semester_column').hide();
                    $('#section_column').hide();
                }
            });
        });
    </script>
@endsection
