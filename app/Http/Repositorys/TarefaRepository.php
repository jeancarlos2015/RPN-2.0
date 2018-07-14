<?php

namespace App\Http\Repositorys;


use App\Http\Models\Tarefa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TarefaRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Tarefa::class);
    }

    public static function listar()
    {

        return collect((new Tarefa)->join('users', 'users.codusuario', '=', 'tarefas.codusuario')
            ->where('users.codusuario', '=', Auth::user()->codusuario)
            ->get());

    }

    public static function listar_tarefas_por_modelo($dado)
    {
        $codorganizacao = $dado['codorganizacao'];
        $codprojeto = $dado['codprojeto'];
        $codmodelo = $dado['codmodelo'];
        return collect(Tarefa::join('users', 'users.codusuario', '=', 'tarefas.codusuario')
            ->where('tarefas.codorganizacao', '=', $codorganizacao)
            ->where('tarefas.codprojeto', '=', $codprojeto)
            ->where('tarefas.codmodelo', '=', $codmodelo)
            ->get());
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codtarefa)
    {
        $value = Tarefa::findOrFail($codtarefa);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_tarefas');
    }

    public static function incluir(Request $request)
    {
        $value = Tarefa::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($codtarefa)
    {
        $value = null;
        try {
            $doc = Tarefa::findOrFail($codtarefa);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}