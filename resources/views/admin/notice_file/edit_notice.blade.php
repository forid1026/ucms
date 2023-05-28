@extends('admin.layout.admin_master');
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
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
                                    <label for="notice_file">Notice FIle</label>
                                    <input type="file" name="notice_file" class="form-control" id="notice_file" required
                                        data-parsley-error-message="Notice File is Required"
                                        value="{{ $noticeInfo->notice_file }}">
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
@endsection
