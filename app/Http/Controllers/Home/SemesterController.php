<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Semester;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SemesterController extends Controller
{

    public function AllSemester()
    {
        $allSemester = Semester::get();
        return view('admin.semester.all_semester', compact('allSemester'));
    }

    public function AddSemester()
    {
        return view('admin.semester.add_semester');
    }

    public function EditSemester($id)
    {
        $semesterInfo = Semester::findOrFail($id);
        return view('admin.semester.edit_semester', compact('semesterInfo'));
    }
    public function StoreSemester(Request $request)
    {

        Semester::insert([
            'semester_name' => $request->semester_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Semester Added Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('all.semester')->with($notification);
    }

    public function UpdateSemester(Request $request)
    {
        $semesterId  = $request->id;
        Semester::findOrFail($semesterId)->update([
            'semester_name' => $request->semester_name
        ]);
        $notification = array(
            'message' => 'Semester Updated Successfully',
            'alert_type' => 'success'
        );

        return redirect()->route('all.semester')->with($notification);
    } //end method

    public function DeleteSemester($id)
    {
        Semester::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Semester Deleted Successfully',
            'alert_type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }


    // all section method
    public function AllSection()
    {
        $allSection = Section::all();
        return view('admin.section.all_section', compact('allSection'));
    }

    public function AddSection()
    {
        $semesters = Semester::all();
        return view('admin.section.add_section', compact('semesters'));
    }

    public function EditSection($id)
    {
        $sectionInfo = Section::findOrFail($id);
        $semesters = Semester::all();
        return view('admin.section.edit_section', compact('sectionInfo', 'semesters'));
    }
    public function StoreSection(Request $request)
    {

        Section::insert([
            'section_name' => $request->section_name,
            'semester_id' => $request->semester_id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Section Added Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('all.section')->with($notification);
    }

    public function UpdateSection(Request $request)
    {
        $sectionId  = $request->id;
        Section::findOrFail($sectionId)->update([
            'section_name' => $request->section_name,
            'semester_id' => $request->semester_id,
        ]);
        $notification = array(
            'message' => 'Section Updated Successfully',
            'alert_type' => 'success'
        );

        return redirect()->route('all.section')->with($notification);
    } //end method

    public function DeleteSection($id)
    {
        Section::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Section Deleted Successfully',
            'alert_type' => 'warning'
        );
        return redirect()->back()->with($notification);
    }


    public function GetSection(Request $request)
    {
        $semester_id = $request->semester_id;
        $section = Section::where('semester_id', $semester_id)->get();
        return response()->json($section);
    }
}
