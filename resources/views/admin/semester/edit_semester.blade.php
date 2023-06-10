@extends('admin.layout.admin_master');
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <style>
        .parsley-errors-list {
            list-style: none;
            padding: 0;
            color: red;
        }
    </style>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row mt-3">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Semester</h3>
                        </div>
                        <!-- form start -->
                        <form id="basicForm" action="{{ route('update.semester') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $semesterInfo->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="semester_name">Semester Name</label>
                                    <input type="text" name="semester_name" class="form-control" id="semester_name"
                                        value="{{ $semesterInfo->semester_name }}" required
                                        data-parsley-required-message="Semester Name is required.">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div>
                                <button type="submit" class="btn btn-primary ml-3">Update Semester</button>
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
