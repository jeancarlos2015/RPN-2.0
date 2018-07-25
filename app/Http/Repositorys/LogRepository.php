<?php

namespace App\Http\Repositorys;


use App\Http\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LogRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Log::class);
    }

    public static function criar($mensagem, $nome)
    {
        $dt = Carbon::now('America/Sao_Paulo');
        $dt->addMinute(23);
        $log = Log::create([

            'nome' => $nome,
            'descricao' => $mensagem,
            'codusuario' => Auth::user()->codusuario,
            'ocorrencia' => $dt
        ]);
        return $log->codlog;
    }

    public static function listar()
    {
        return Log::all()->where('codusuario', Auth::user()->codusuario);
    }

    public static function listar_tres_ultimos_logs($qt_logs)
    {
        $logs_buffer = self::listar()->sortByDesc('codlog');
        $logs = [];
        for ($indice = 0; $indice < $qt_logs; $indice++) {
            array_push($logs, $logs_buffer[$indice]);
        }
        return $logs;
    }

    public static function log()
    {
        return self::listar()->sortByDesc('codlog')->first();
    }
}
