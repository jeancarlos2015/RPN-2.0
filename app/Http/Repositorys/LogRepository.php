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

    public static function listar_tres_ultimos_logs($qt_logs){
        $logs_buffer = self::listar()->sortByDesc('codlog');
        $logs = [];
        for ($indice=0;$indice<$qt_logs;$indice++){
            array_push($logs, $logs_buffer[$indice]);
        }
        return $logs;
    }

    public static function log(){
        $log = self::listar()->sortByDesc('codlog')[1];
        $logs = [];
        array_push($logs, $log);
        return $logs;
    }
}
