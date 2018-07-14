<?php

namespace App\Http\Repositorys;


use App\Http\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Log::class);
    }

    public static function criar($mensagem, $nome)
    {
        Log::create([

            'nome' => $nome,
            'descricao' => $mensagem,
            'codusuario' => \Auth::user()->codusuario

        ]);

    }

    public static function listar()
    {

        return collect((new Log())->where('logs.codusuario', '=', Auth::user()->codusuario)
            ->get());

    }

}
