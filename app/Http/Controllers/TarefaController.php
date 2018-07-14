<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Tarefa;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\TarefaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TarefaController extends Controller
{

    public function index($codorganizacao, $codprojeto, $codmodelo)

    {
        $dado['codorganizacao'] = $codorganizacao;
        $dado['codprojeto'] = $codprojeto;
        $dado['codmodelo'] = $codmodelo;

        $tarefas = TarefaRepository::listar_tarefas_por_modelo($dado);

        $titulos = Tarefa::titulos();
        $organizacao = Organizacao::findOrFail($codorganizacao);
        $projeto = Projeto::findOrFail($codprojeto);
        $modelo = Modelo::findOrFail($codmodelo);
        $tipo = 'tarefa';
        $log = LogRepository::log();
        return view('controle_tarefas.index', compact('tarefas', 'titulos', 'organizacao', 'projeto', 'modelo', 'tipo','log'));
    }

    public function todas_tarefas()
    {
        $tarefas = TarefaRepository::listar();
        $titulos = Tarefa::titulos();
        $tipo = 'tarefa';
        $log = LogRepository::log();

        return view('controle_tarefas.all', compact('tarefas', 'titulos','tipo','log'));
    }

    public function create($codorganizacao, $codprojeto, $codmodelo)
    {
        $dados = Projeto::dados();
        $organizacao = Organizacao::findOrFail($codorganizacao);
        $projeto = Projeto::findOrFail($codprojeto);
        $modelo = Modelo::findOrFail($codmodelo);
        return view('controle_tarefas.create', compact('dados', 'organizacao', 'projeto', 'modelo'));
    }


    public function store(Request $request)
    {
        $projeto = Projeto::findOrFail($request->codprojeto);
        $organizacao = Organizacao::findOrFail($request->codorganizacao);
        $modelo = Modelo::findOrFail($request->codmodelo);
        $request->request->add([
            'codusuario' => Auth::user()->codusuario
        ]);
        $tarefa = Tarefa::create($request->all());
        if (isset($tarefa)) {
            flash('Tarefa criada com sucesso!!');
        } else {
            flash('Tarefa não foi criada!!');
        }
        return redirect()->route('controle_tarefas_index', [
            'codorganizacao' => $organizacao->codorganizacao,
            'codprojeto' => $projeto->codprojeto,
            'codmodelo' => $modelo->codmodelo
        ]);
    }


    public function show($codtarefa)
    {
        $tarefa = Tarefa::findOrFail($codtarefa);
        return view('controle_tarefas.show', compact('tarefa'));
    }


    public function edit($codtarefa)
    {
        $tarefa = Tarefa::findOrFail($codtarefa);
        $dados = Tarefa::dados();
        $dados[0]->valor = $tarefa->nome;
        $dados[1]->valor = $tarefa->descricao;
        return view('controle_tarefas.edit', compact('dados', 'tarefa'));
    }


    public function update(Request $request, $codtarefa)
    {
        $tarefa = Tarefa::findOrFail($codtarefa);
        $tarefa->update($request->all());
        LogRepository::criar("Tarefa Atualizada Com sucesso", "Rota De Atualização de organização");
        if (isset($tarefa)) {
            flash('Tarefa atualizada com sucesso!!');
        } else {
            flash('Tarefa não foi atualizada!!');
        }
        return redirect()->route('controle_tarefas_index', [
            'codorganizacao' => $tarefa->codorganizacao,
            'codprojeto' => $tarefa->codprojeto,
            'codmodelo' => $tarefa->codmodelo
        ]);
    }


    public function destroy($id)
    {
//        dd($id);
        $tarefa = Tarefa::findOrFail($id);

        $projeto = $tarefa->projeto;
        $organizacao = $tarefa->organizacao;
        $modelo = $tarefa->modelo;
        LogRepository::criar("Tarefa Excluída Com sucesso", "Rota De Exclusão de tarefa");
        try {
            $tarefa->delete();
            if (!$tarefa->exists) {
                flash('Tarefa excluída com sucesso!!');
            } else {
                flash('Tarefa não foi excluída!!');
            }
        } catch (\Exception $e) {
        }


        if (empty($projeto->codprojeto) || empty($organizacao->codorganizacao) || empty($modelo->codmodelo)) {
            $titulos = Tarefa::titulos();
            $regras = Tarefa::join('users', 'users.codusuario', '=', 'tarefas.codusuario')->get();
            return view('controle_tarefas.all', compact('titulos', 'tarefas'));
        } else {
            return redirect()->route('controle_tarefas_index', [
                'codorganizacao' => $organizacao->codorganizacao,
                'codprojeto' => $projeto->codprojeto,
                'codmodelo' => $modelo->codmodelo
            ]);
        }
    }
}
