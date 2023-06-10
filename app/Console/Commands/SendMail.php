<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail to birthday users running this command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $userMail = User::select('email')->where('birth_date', $todayDate)->get();
        $emails = [];
        foreach ($userMail as $key => $mail) {
            $emails[] = $mail['email'];
        }

        Mail::send('emails.birth_day_email', [], function ($message) use ($emails) {
            $message->to($emails)->subject('Birthday Wish');
        });
    }
}
