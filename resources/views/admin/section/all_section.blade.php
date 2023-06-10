@extends('admin.layout.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title">All Section</h3>
                                <a href="{{ route('add.section') }}" class="btn btn-info">Add Section</a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>Sl</td>
                                        <td>Semester Name</td>
                                        <td>Section Name</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allSection as $key => $section)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $section->semester_id }}</td>
                                            <td>{{ $section->section_name }}</td>
                                            <td>
                                                <a href="{{ route('edit.section', $section->id) }}" class="btn btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a id="delete" href="{{ route('delete.section', $section->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash-alt"
                                                        aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Sl</td>
                                        <td>Section Name</td>
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
@endsection
