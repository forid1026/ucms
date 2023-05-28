@include('admin.layout.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        @if (Auth::user()->role === 'admin')
            @include('admin.layout.admin_navbar')
        @elseif (Auth::user()->role === 'teacher')
            @include('teacher.layout.teacher_navbar')
        @elseif (Auth::user()->role === 'student')
            @include('student.layout.student_navbar')
        @endif
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @if (Auth::user()->role === 'admin')
            @include('admin.layout.admin_sidebar')
            <div class="content-wrapper">
                @yield('admin')
            </div>
        @elseif (Auth::user()->role === 'teacher')
            @include('teacher.layout.teacher_sidebar')
            <div class="content-wrapper">
                @yield('teacher')
            </div>
        @elseif (Auth::user()->role === 'student')
            @include('student.layout.student_sidebar')
            <div class="content-wrapper">
                @yield('student')
            </div>
        @endif

        <!-- Content Wrapper. Contains page content -->
        {{--  <div class="content-wrapper">
            @yield('content')
        </div>  --}}
        <!-- /.content-wrapper -->
        @include('admin.layout.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-light">
            @yield('control-sidebar')
        </aside>
        <!-- /.control-sidebar -->


    </div>
    <!-- ./wrapper -->

    @include('admin.layout.script')
</body>

</html>
