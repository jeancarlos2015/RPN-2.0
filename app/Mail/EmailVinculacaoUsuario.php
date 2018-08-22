<?php

namespace App\Mail;

use App\http\Models\Repositorio;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVinculacaoUsuario extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->subject('Vinculação - RPN ')->view('mails.email_vinculacao_de_usuario',compact('repositorio'));
    }
}
