<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\Section;
use App\Models\Semester;
use App\Models\User;
use App\Notifications\NoticeSuccessful;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NoticeController extends Controller
{
    public function AllNotice()
    {
        $allNotices = Notice::get();
        return view('admin.notice_file.all_notice', compact('allNotices'));
    } //end method
    public function StoreNotice(Request $request)
    {
        // dd($request->all());
        if ($request->file('notice_file')) {
            $notice_file = $request->file('notice_file');
            $name_gen = hexdec(uniqid()) . '.' . $notice_file->getClientOriginalExtension();
            $notice_file->move(('upload/notice_files/'), $name_gen);
            $save_url = 'upload/notice_files/' . $name_gen;

            $notice = new Notice();
            $notice->title = $request->title;
            $notice->description = $request->description;
            $notice->notice_file = $save_url;
            $notice->notice_type = $request->notice_type;
            if ($request->notice_type == 'semester_wise') {
                $notice->semester_id = $request->semester_id;
                $notice->section_id = $request->section_id;
            }
            $notice->created_at = Carbon::now();
            $notice->save();
            $Notice = array(
                'message' => 'Notice Added Successfully',
                'alert_type' => 'success'
            );
        } else {
            $notice = new Notice();
            $notice->title = $request->title;
            $notice->description = $request->description;
            $notice->notice_type = $request->notice_type;
            if ($request->notice_type == 'semester_wise') {
                $notice->semester_id = $request->semester_id;
                $notice->section_id = $request->section_id;
            }
            $notice->created_at = Carbon::now();
            $notice->save();
            $Notice = array(
                'message' => 'Notice Added Successfully without file',
                'alert_type' => 'success'
            );
        }

        return redirect()->route('all.notice')->with($Notice);
    }

    public function AddNotice()
    {
        $semesters = Semester::all();
        $sections = Section::all();
        return view('admin.notice_file.add_notice', compact('semesters', 'sections'));
    }
    public function EditNotice($id)
    {
        $semesters = Semester::all();
        $sections = Section::all();
        $noticeInfo = Notice::findOrFail($id);
        return view('admin.notice_file.edit_notice', compact('noticeInfo', 'semesters', 'sections'));
    }

    public function UpdateNotice(Request $request)
    {
        $noticeId  = $request->id;
        if ($request->file('notice_file')) {
            $notice_file = $request->file('notice_file');
            $name_gen = hexdec(uniqid()) . '.' . $notice_file->getClientOriginalExtension();
            $save_url = 'upload/notice_files/' . $name_gen;

            Notice::findOrFail($noticeId)->update([
                'title' => $request->title,
                'notice_file' => $save_url,
                'description' => $request->description,
                'semester_id' => $request->semester_id,
                'section_id' => $request->section_id,
            ]);
            $Notice = array(
                'message' => 'Notice Updated Successfully',
                'alert_type' => 'success'
            );
        } else {
            Notice::findOrFail($noticeId)->update([
                'title' => $request->title,
                'description' => $request->description,
                'semester_id' => $request->semester_id,
                'section_id' => $request->section_id,
            ]);
            $Notice = array(
                'message' => 'Notice Updated Successfully without file',
                'alert_type' => 'success'
            );
        }

        return redirect()->route('all.notice')->with($Notice);
    } //end method

    public function markAsRead()
    {
        Auth::user()->unreadNotification->markAsRead();
        return redirect()->back();
    }
    public function DeleteNotice($id)
    {
        Notice::findOrFail($id)->delete();
        return redirect()->back();
    }
}
