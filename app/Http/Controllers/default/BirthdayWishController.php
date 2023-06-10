<?php

namespace App\Http\Controllers\Default;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BirthdayWishController extends Controller
{
    public function TodaysBirthDay()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $todayBirthday = User::where('birth_date', $todayDate)->get();
        // dd($todayBirthday);
        return view('emails.birth_day_email');
    }
}
