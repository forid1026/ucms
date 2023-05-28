<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function AllNotice()
    {
        $allNotices = Notification::get();
        return view('admin.notice_file.all_notice', compact('allNotices'));
    } //end method
    public function StoreNotice(Request $request)
    {
        // dd($request->all());
        if ($request->file('notice_file')) {
            $notice_file = $request->file('notice_file');
            $name_gen = hexdec(uniqid()) . '.' . $notice_file->getClientOriginalExtension();
            $save_url = 'upload/notice_files/' . $name_gen;
            Notification::insert([
                'title' => $request->title,
                'notice_file' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Notice Added Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('all.notice')->with($notification);
    }

    public function AddNotice()
    {
        return view('admin.notice_file.add_notice');
    }
    public function EditNotice($id)
    {
        $noticeInfo = Notification::findOrFail($id);
        return view('admin.notice_file.edit_notice', compact('noticeInfo'));
    }

    public function UpdateNotice(Request $request)
    {
        $noticeId  = $request->id;
        if ($request->file('notice_file')) {
            $notice_file = $request->file('notice_file');
            $name_gen = hexdec(uniqid()) . '.' . $notice_file->getClientOriginalExtension();
            $save_url = 'upload/notice_files/' . $name_gen;

            Notification::findOrFail($noticeId)->update([
                'title' => $request->title,
                'notice_file' => $request->$save_url,
            ]);
        }
        $notification = array(
            'message' => 'Notice Updated Successfully',
            'alert_type' => 'success'
        );
        return redirect()->route('all.notice')->with($notification);
    } //end method

    public function DeleteNotice($id)
    {
        Notification::findOrFail($id)->delete();
        return redirect()->back();
    }
}
