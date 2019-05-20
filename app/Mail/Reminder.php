<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Reminder extends Mailable
{
    use Queueable, SerializesModels;

    public $expiraciones;

    public function __construct($expiraciones)
    {
        $this->expiraciones = $expiraciones;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->expiraciones['dominio']['mes']);
        // dd($this->expiraciones['dominio']);
        // dd($this->expiraciones['dominio']['semana'][0]->nombre);
        try {
            return $this->markdown('emails.reminder')->subject('DOMINIOS POR CADUCAR!');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
