@extends('admin.layout.admin_master')
@section('admin')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="card-title">All Teacher</h3>
                                <a href="{{ route('add.teacher') }}" class="btn btn-info">Add Teacher</a>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <td>Sl</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Phone</td>
                                        <td>Birth Date</td>
                                        <td>Photo</td>
                                        <td>Action</td>
                                    </tr>
                                    @foreach ($allTeachers as $key => $teacher)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $teacher->name }}</td>
                                            <td>{{ $teacher->email }}</td>
                                            <td>{{ $teacher->phone }}</td>
                                            <td>{{ $teacher->birth_date }}</td>
                                            <td><img width="40" height="40" src="{{ asset($teacher->photo) }}"
                                                    alt="">
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.teacher', $teacher->id) }}" title="Edit Student"
                                                    class="btn btn-info">
                                                    <i class="fas fa-edit    "></i>
                                                </a>
                                                <a id="delete" title="Delete Teacher"
                                                    href="{{ route('delete.teacher', $teacher->id) }}"
                                                    class="btn btn-danger"><i class="fa fa-trash-alt"
                                                        aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Sl</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Phone</td>
                                        <td>Birthdate</td>
                                        <td>Photo</td>
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
