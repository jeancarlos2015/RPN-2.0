<?php

namespace App\Http\Repositorys;


use App\Http\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LogRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Log::class);
    }

    public static function criar($mensagem, $nome, $pagina, $acao)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s');
        $log = Log::create([
            'nome' => $nome,
            'descricao' => $mensagem,
            'cod_usuario' => Auth::user()->cod_usuario,
            'pagina' => $pagina,
            'acao' => $acao,
            'created_at' => $date
        ]);
        self::limpar_cache();
        return $log->cod_log;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_logs');
    }

    public static function listar()
    {
        return Cache::remember('listar_logs', 2000, function () {
            return collect(Log::all());
        });
    }

    public static function listar_tres_ultimos_logs($qt_logs)
    {
        $logs_buffer = self::listar()->sortByDesc('cod_log');
        $logs = [];
        for ($indice = 0; $indice < $qt_logs; $indice++) {
            array_push($logs, $logs_buffer[$indice]);
        }
        return $logs;
    }

    public static function log()
    {
        return self::listar()->sortByDesc('cod_log')->first();
    }
}
