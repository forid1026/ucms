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
                            <h3 class="card-title">Student Data Update</h3>
                        </div>
                        <!-- form start -->
                        <form id="quickForm" action="{{ route('update.student') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $studentInfo->id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input value="{{ $studentInfo->name }}" type="text" name="name"
                                        class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username" readonly
                                        value="{{ $studentInfo->username }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email" value="{{ $studentInfo->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name="phone" class="form-control" id="phone"
                                        placeholder="Phone" value="{{ $studentInfo->phone }}">
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control date_picker"
                                        id="date_of_birth" autocomplete="off" placeholder="Date of Birth"
                                        value="{{ $studentInfo->birth_date }}">
                                </div>
                                <div class="row mb-3">
                                    <div class="col text-secondary">
                                        @error('student_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <label for="" class="mb-2"><b>Student Image</b></label>
                                        <input type="file" name="student_image" id="student_image" class="form-control">
                                    </div>
                                    <div class="col-12 mt-3 text-secondary">
                                        <img id="showStudentImage"
                                            src="{{ !empty($studentInfo->image) ? url($studentInfo->image) : url('upload/no-image.jpg') }}"
                                            alt="Admin" width="200px" height="200px">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            // image on load
            $('#student_image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showStudentImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

            });
        });
    </script>
@endsection
