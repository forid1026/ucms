<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class TeacherController extends Controller
{
    public function TeacherDashboard()
    {
        return view('teacher.teacher_dashboard');
    }

    public function RedirectDashboard()
    {
        return redirect()->route('teacher.dashboard');
    }


    public function TeacherLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function AllTeacher()
    {
        $allTeachers = User::where('role', 'teacher')->get();
        return view('teacher.all_teacher', compact('allTeachers'));
    }

    public function EditTeacher($id)
    {
        $teacherInfo = User::findOrFail($id);
        return view('teacher.edit_teacher', compact('teacherInfo'));
    }
    public function StoreTeacher(Request $request)
    {
        // dd($request->all());
        if ($request->file('teacher_image')) {
            $image = $request->file('teacher_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 600)->save('upload/teacher_image/' . $name_gen);
            $save_url = 'upload/teacher_image/' . $name_gen;
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'birth_date' => $request->date_of_birth,
                'role' => 'teacher',
                'user_id' => $request->username,
                'password' => Hash::make($request->password),
                'photo' => $save_url,
            ]);
            $notification = array(
                'message' => 'Teacher Added Successfully',
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
                'message' => 'Teacher Added Successfully without Image',
                'alert_type' => 'success'
            );
        }
        return redirect()->route('all.teacher');
    }

    public function AddTeacher()
    {
        return view('teacher.add_teacher');
    }
    public function UpdateTeacher(Request $request)
    {
        $teacherId  = $request->id;
        if ($request->file('teacher_image')) {
            $image = $request->file('teacher_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 600)->save('upload/teacher_image/' . $name_gen);
            $save_url = 'upload/teacher_image/' . $name_gen;

            User::findOrFail($teacherId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'birth_date' => $request->date_of_birth,
                'photo' => $save_url,
            ]);
            $notification = array(
                'message' => 'Teacher Updated Successfully',
                'alert_type' => 'success'
            );
        } else {
            User::findOrFail($teacherId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'phone' => $request->phone,
                'birth_date' => $request->date_of_birth,
            ]);
            $notification = array(
                'message' => 'Teacher Updated Successfully Without Image',
                'alert_type' => 'success'
            );
        }
        // return redirect()->route('all.student')->with($notification);
        return redirect()->route('all.teacher');
    } //end method

    public function DeleteTeacher($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back();
    }



    public function TeacherProfile()
    {
        $id = Auth::user()->id;
        $teacherData = User::find($id);
        return view('teacher.teacher_profile_view', compact('teacherData'));
    } //end method

    public function TeacherProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->birth_date = $request->date_of_birth;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/teacher_images/' . $data->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(('upload/teacher_images'), $fileName);
            $data['photo'] = $fileName;
        }
        $data->save();

        $notification = array(
            'message' => 'Teacher Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } //end method

    public function ChangeTeacherPassword()
    {
        return view('teacher.teacher_change_password');
    } //end method


    public function UpdateTeacherPassword(Request $request)
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
