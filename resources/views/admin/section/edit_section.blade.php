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
                            <h3 class="card-title">Update Section</h3>
                        </div>
                        <!-- form start -->
                        <form id="basicForm" action="{{ route('update.section') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $sectionInfo->id }}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="semester_name">Section Name</label>
                                    <select name="semester_id" id="semester_id" class="form-control">
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}"
                                                {{ $semester->id == $sectionInfo->semester_id ? 'selected' : '' }}>
                                                {{ $semester->semester_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="section_name">Section Name</label>
                                    <input type="text" name="section_name" class="form-control" id="section_name"
                                        value="{{ $sectionInfo->section_name }}" required
                                        data-parsley-required-message="Section Name is required.">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div>
                                <button type="submit" class="btn btn-primary ml-3">Update Section</button>
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
