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
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Student</h3>
                        </div>
                        <!-- form start -->
                        <form id="basicForm" action="{{ route('store.student') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name" required
                                        required data-parsley-pattern="[a-zA-Z ]+$" data-parsley-trigger="keyup"
                                        data-parsley-required-message="Name is required."
                                        data-parsley-pattern-message="Name Must Be Alphabet.">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="number" name="username" class="form-control" id="username" required
                                        data-parsley-error-message="Username is Required"
                                        placeholder="Enter Your Teacher ID">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Email" required data-parsley-error-message="Email is Required">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input data-parsley-minlength="8" type="password" name="password" class="form-control"
                                        id="password" name="password" value="12345678"
                                        placeholder="Password Must Be 8 Digit" required
                                        data-parsley-error-message="Required, Password is must be 8 digit!">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name="phone" class="form-control" id="phone"
                                        placeholder="Phone" required
                                        data-parsley-pattern="/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/"
                                        data-parsley-trigger="keyup"
                                        data-parsley-required-message="Phone Number is required."
                                        data-parsley-pattern-message="Invalid Phone Number.">
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control date_picker"
                                        id="date_of_birth" placeholder="Date of Birth" required
                                        data-parsley-error-message="Birth Date is required" autocomplete="off">
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
                                        <img id="showStudentImage" src=" {{ url('upload/no-image.jpg') }}" alt="Admin"
                                            width="200px" height="200px">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Teacher</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
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
    <script>
        $('#basicForm').parsley();
    </script>
@endsection
