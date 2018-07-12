<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{

    public function index($organizacao_id, $projeto_id, $modelo_id)
    {
        $tarefas = Tarefa::join('users', 'users.id','=','tarefas.user_id')
                ->where('tarefas.organizacao_id','=',$organizacao_id)
                ->where('tarefas.projeto_id','=',$projeto_id)
                ->where('tarefas.modelo_id','=',$modelo_id)
                ->get();

        $titulos = Tarefa::titulos();
        $organizacao = Organizacao::findOrFail($organizacao_id);
        $projeto = Projeto::findOrFail($projeto_id);
        $modelo = Modelo::findOrFail($modelo_id);
        $tipo = 'tarefa';

        return view('controle_tarefas.index', compact('tarefas','titulos','organizacao','projeto','modelo','tipo'));
    }

    public function todas_tarefas(){
        $tarefas = Tarefa::all();
        $titulos = Tarefa::titulos();
        return view('controle_tarefas.all',compact('tarefas','titulos'));
    }

    public function create($organizacao_id, $projeto_id, $modelo_id)
    {
        $dados = Projeto::dados();
        $organizacao = Organizacao::findOrFail($organizacao_id);
        $projeto = Projeto::findOrFail($projeto_id);
        $modelo = Modelo::findOrFail($modelo_id);
        return view('controle_tarefas.create', compact('dados','organizacao','projeto','modelo'));
    }


    public function store(Request $request)
    {
        $projeto = Projeto::findOrFail($request->projeto_id);
        $organizacao = Organizacao::findOrFail($request->organizacao_id);
        $modelo = Modelo::findOrFail($request->modelo_id);
        $request->request->add([
            'user_id' => Auth::user()->id
        ]);
        $tarefa = Tarefa::create($request->all());
        if(isset($tarefa)){
            flash('Tarefa criada com sucesso!!');
        }else{
            flash('Tarefa não foi criada!!');
        }
        return redirect()->route('controle_tarefas_index', [
            'organizacao_id' => $organizacao->id,
            'projeto_id' => $projeto->id,
            'modelo_id' => $modelo->id
        ]);
    }


    public function show($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('controle_tarefas.show', compact('tarefa'));
    }


    public function edit($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $dados = Tarefa::dados();
        $dados[0]->valor = $tarefa->nome;
        $dados[1]->valor = $tarefa->descricao;
        return view('controle_tarefas.edit', compact('dados','tarefa'));
    }


    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::findOrFail($id);
        $tarefa->update($request->all());
        if(isset($tarefa)){
            flash('Tarefa atualizada com sucesso!!');
        }else{
            flash('Tarefa não foi atualizada!!');
        }
        return redirect()->route('controle_tarefas_index', [
            'organizacao_id' => $tarefa->organizacao_id,
            'projeto_id' => $tarefa->projeto_id,
            'modelo_id' => $tarefa->modelo_id
        ]);
    }


    public function destroy($id)
    {
        dd($id);
        $tarefa = Tarefa::findOrFail($id);

        $projeto = $tarefa->projeto;
        $organizacao = $tarefa->organizacao;
        $modelo = $tarefa->modelo;

        try {
            $tarefa->delete();
            if(!$tarefa->exists){
                flash('Tarefa excluída com sucesso!!');
            }else{
                flash('Tarefa não foi excluída!!');
            }
        } catch (\Exception $e) {
        }


        if (empty($projeto->id) || empty($organizacao->id) || empty($modelo->id)){
            $titulos = Tarefa::titulos();
            $regras = Tarefa::join('users', 'users.id','=','tarefas.user_id')->get();
            return view('controle_tarefas.all',compact('titulos','tarefas'));
        }else{
            return redirect()->route('controle_tarefas_index', [
                'organizacao_id' => $organizacao->id,
                'projeto_id' => $projeto->id,
                'modelo_id' => $modelo->id
            ]);
        }
    }
}
