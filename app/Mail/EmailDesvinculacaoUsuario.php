<?php

namespace App\Mail;

use App\http\Models\Repositorio;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailDesvinculacaoUsuario extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Repositorio $repositorio)
    {
        $this->repositorio = $repositorio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $repositorio = $this->repositorio;
        return $this->subject('Desvinculação - RPN ')->view('mails.email_desvinculacao_de_usuario',compact('repositorio'));
    }
}
