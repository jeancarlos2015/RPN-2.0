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

        return collect((new Tarefa)->join('users', 'users.id', '=', 'tarefas.user_id')
            ->where('users.id', '=', Auth::user()->id)
            ->get());

    }

    public static function listar_tarefas_por_modelo($organizacao_id, $projeto_id, $modelo_id)
    {
        return collect(Tarefa::join('users', 'users.id', '=', 'tarefas.user_id')
            ->where('tarefas.organizacao_id', '=', $organizacao_id)
            ->where('tarefas.projeto_id', '=', $projeto_id)
            ->where('tarefas.modelo_id', '=', $modelo_id)
            ->get());
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $id)
    {
        $value = Tarefa::findOrFail($id);
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

    public static function excluir($id)
    {
        $value = null;
        try {
            $doc = Tarefa::findOrFail($id);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

}
