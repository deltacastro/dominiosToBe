<?php

namespace App\Http\Controllers\Custom;

use Mail;
use Carbon;
use App\Dominio;
use App\Hosting;
use App\Correo;
use App\Mail\Reminder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{

    public function __construct()
    {
        $this->dominioModel = new Dominio;
        $this->correoModel = new Correo;
        $this->hostingModel = new Hosting;
        $this->expiraciones = [];
    }

    public function build ()
    {
        $this->expiracion['dominio'] = [
            'mes' => $this->dominioModel->getMesExpira(),
            'semana' => $this->dominioModel->getSemanaExpira()
        ];
        $this->expiracion['hosting'] = [
            'mes' => $this->hostingModel->getMesExpira(),
            'semana' => $this->hostingModel->getSemanaExpira()
        ];
        $email = $this->correoModel->getAllList()->toArray();
        Mail::to($email)->send(new Reminder($this->expiracion));
    }
}
