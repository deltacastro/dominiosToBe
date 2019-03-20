<?php

namespace App\Http\Controllers\Custom;

use Mail;
use Carbon;
use App\Dominio;
use App\Mail\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{

    public function __construct()
    {
        $this->dominioModel = new Dominio;
        $this->expiraciones = [];
    }

    public function build ()
    {
        $this->expiracion['dominio'] = [
            'mes' => $this->dominioModel->getMesExpira(),
            'semana' => $this->dominioModel->getSemanaExpira()
        ];

        $email = [
            'abelcastro@tobe.mx'
        ];
        Mail::to($email)->send(new Reminder($this->expiracion));
    }
}
