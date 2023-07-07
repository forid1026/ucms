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
                            <h3 class="card-title">Notice Details</h3>
                        </div>
                        <div class="card-body">
                            <h3>{{ $noticeDetails->title }}</h3>
                            <p>{!! $noticeDetails->description !!}</p>
                            @if ($noticeDetails->notice_file != null)
                                <iframe src="{{ asset($noticeDetails->notice_file) }}" frameBorder="0" scrolling="auto"
                                    height="500" width="100%"></iframe>
                            @else
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
