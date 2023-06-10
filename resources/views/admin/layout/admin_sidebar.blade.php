@php
    $id = Auth::user()->id;
    $adminData = App\Models\User::find($id);
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{--  <a href="index3.html" class="brand-link">
        <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
    </a>  --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/no-image.jpg') }}"
                    class="img-circle elevation-2" alt="user avatar">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ $adminData->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                        <p>
                            Student Manage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all.student') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Student</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Student</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                        <p>
                            Teachers Manage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all.teacher') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Teacher</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.teacher') }}l" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Teacher</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                        <p>
                            Semester Manage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all.semester') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Semester</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.semester') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Semester</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                        <p>
                            Section Manage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all.section') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Section</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.section') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Section</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="#" class="nav-link">
                        <i class="fa fa-file-pdf  nav-icon" aria-hidden="true"></i>
                        <p>
                            Notice Manage
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('all.notice') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Notice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.notice') }}" class="nav-link active">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Notice</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
