<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function StudentDashboard()
    {
        return view('student.student_dashboard');
    }
}
