<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\Reminder;
use App\Jobs\SendReminderEmail;
use Illuminate\Http\Request;
use Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = [
            'abelcastro@tobe.mx',
            'daviddominguez@tobe.mx'
        ];
        $user = auth()->user();
        $when = Carbon\Carbon::now()->addSeconds(1);
        dispatch((new SendReminderEmail($user, $email))->delay($when));
        return view('home');
    }
}
