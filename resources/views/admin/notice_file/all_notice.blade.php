@extends('admin.layout.admin_master')
@section('admin')
    <style>
        ._df_thumb {
            width: 50px !important;
            height: 50px !important;
            margin: 0 !important;
        }
    </style>
    <!-- Flipbook StyleSheet -->
    <link href="{{ asset('backend/dflip/css/dflip.min.css') }} " rel="stylesheet" type="text/css">
    <!-- Icons Stylesheet -->
    <link href="{{ asset('backend/dflip/css/themify-icons.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title">All Notice</h3>
                                <a href="{{ route('add.notice') }}" class="btn btn-info">Add Notice</a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>Sl</td>
                                        <td>Title</td>
                                        <td>description</td>
                                        <td>Notice File</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allNotices as $key => $notice)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $notice->title }}</td>
                                            <td width="50%" class="des">
                                                <div style="height: 50px; overflow:auto;">
                                                    {!! $notice->description !!}
                                                </div>
                                            </td>
                                            <td>
                                                @if ($notice->notice_file == null)
                                                    No File Attach
                                                @else
                                                    <div class="_df_thumb" id="df_manual_thumb" height="100%"
                                                        source="{{ asset($notice->notice_file) }}"
                                                        thumb="{{ asset('upload/thumbnail.jpg') }}"> View Pdf</div>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ route('edit.notice', $notice->id) }}" class="btn btn-info">
                                                    <i class="fas fa-edit    "></i>
                                                </a>
                                                <a id="delete" href="{{ route('delete.notice', $notice->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash-alt"
                                                        aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Sl</td>
                                        <td>Title</td>
                                        <td>Notice</td>
                                        <td>Action</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- Flipbook main Js file -->
    <script src="{{ asset('backend/dflip/js/dflip.min.js') }}" type="text/javascript"></script>
@endsection
