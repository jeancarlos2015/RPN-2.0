<?php

namespace App\Http\Repositorys;


use App\Http\Models\Log;

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
}
