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
        $countDominioSemana = count($this->expiracion['dominio']['semana']);
        $countDominioMes = count($this->expiracion['dominio']['mes']);
        $countHostingSemana = count($this->expiracion['hosting']['semana']);
        $countHostingMes = count($this->expiracion['hosting']['mes']);
        if ($countDominioSemana > 0 || $countDominioMes > 0 || $countHostingSemana > 0 || $countHostingMes > 0) {
            try {
                Mail::to($email)->send(new Reminder($this->expiracion));
            } catch (\Throwable $th) {
                dd('error');
            }
        } else {
            return 'nada';
        }
    }
}
