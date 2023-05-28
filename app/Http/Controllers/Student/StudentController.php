<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class StudentController extends Controller
{

    public function AllStudent()
    {
        $allStudents = User::where('role', 'student')->get();
        return view('student.all_student', compact('allStudents'));
    } //end method
    public function StoreStudent(Request $request)
    {
        // dd($request->all());
        if ($request->file('student_image')) {
            $image = $request->file('student_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 600)->save('upload/student_image/' . $name_gen);
            $save_url = 'upload/student_image/' . $name_gen;
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'birth_date' => $request->date_of_birth,
                'role' => 'student',
                'user_id' => $request->username,
                'password' => Hash::make($request->password),
                'photo' => $save_url,
            ]);
            $notification = array(
                'message' => 'Student Added Successfully',
                'alert_type' => 'success'
            );
        } else {
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'birth_date' => $request->date_of_birth,
                'role' => 'teacher',
                'user_id' => $request->username,
            ]);
            $notification = array(
                'message' => 'Student Added Successfully without Image',
                'alert_type' => 'success'
            );
        }
        return redirect()->route('all.student');
    }

    public function AddStudent()
    {
        return view('student.add_student');
    }
    public function EditStudent($id)
    {
        $studentInfo = User::findOrFail($id);
        return view('student.edit_student', compact('studentInfo'));
    }

    public function UpdateStudent(Request $request)
    {
        $studentId  = $request->id;
        if ($request->file('student_image')) {
            $image = $request->file('student_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 600)->save('upload/student_image/' . $name_gen);
            $save_url = 'upload/student_image/' . $name_gen;

            User::findOrFail($studentId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'birth_date' => $request->date_of_birth,
                'photo' => $save_url,
            ]);
            $notification = array(
                'message' => 'Student Updated Successfully',
                'alert_type' => 'success'
            );
        } else {
            User::findOrFail($studentId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'birth_date' => $request->date_of_birth,
            ]);
            $notification = array(
                'message' => 'Student Updated Successfully Without Image',
                'alert_type' => 'success'
            );
        }
        // return redirect()->route('all.student')->with($notification);
        return redirect()->route('all.student');
    } //end method

    public function DeleteStudent($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function StudentLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function StudentProfile()
    {
        $id = Auth::user()->id;
        $studentData = User::find($id);
        return view('student.student_profile_view', compact('studentData'));
    } //end method

    public function StudentProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->birth_date = $request->date_of_birth;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/student_images/' . $data->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(('upload/student_images'), $fileName);
            $data['photo'] = $fileName;
        }
        $data->save();

        $notification = array(
            'message' => 'Student Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('student.profile')->with($notification);
    } //end method

    public function ChangeStudentPassword()
    {
        return view('student.student_change_password');
    } //end method


    public function UpdateStudentPassword(Request $request)
    {
        // validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_new_password' => 'required|same:new_password'
        ]);


        // match the old password
        $hashedPassword = auth::user()->password;
        if (!Hash::check($request->old_password, $hashedPassword)) {
            return back()->with('error', "Old Password Doesn't Match!");
        } else {
            // update the new password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return back()->with('status', 'Password Change Successfully');
        }
    }
}
