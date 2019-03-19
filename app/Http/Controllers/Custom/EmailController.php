<?php

namespace App\Http\Controllers\Custom;

use Mail;
use Carbon;
use App\Dominios;
use App\Mail\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function build ()
    {

        $email = [
            'abelcastro@tobe.mx',
            'daviddominguez@tobe.mx'
        ];
        // Mail::to($email)->send(new Reminder());
    }
}
