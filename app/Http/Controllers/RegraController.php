<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;
use App\Http\Models\Tarefa;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\RegraRepository;
use App\Http\Repositorys\TarefaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegraController extends Controller
{
    public function index($codorganizacao, $codprojeto, $codmodelo)
    {
        $dado['codorganizacao'] = $codorganizacao;
        $dado['codprojeto'] = $codprojeto;
        $dado['codmodelo'] = $codmodelo;

        $regras = RegraRepository::listar_regras_por_modelo($dado);
        $titulos = Regra::titulos();
        $organizacao = Organizacao::findOrFail($codorganizacao);
        $projeto = Projeto::findOrFail($codprojeto);
        $modelo = Modelo::findOrFail($codmodelo);
        $tipo = 'regra';
        $logs = LogRepository::listar();
        return view('controle_regras.index', compact('titulos', 'organizacao', 'projeto', 'modelo','logs','regras', 'tipo'));
    }

    public function todas_regras()
    {
        $regras = RegraRepository::listar();
        $titulos = Regra::titulos();
        $tarefas = null;
        $tipo = 'regra';
        $logs = LogRepository::listar();
        return view('controle_regras.all', compact('regras', 'titulos','tarefas','tipo','logs'));
    }

    public function create($codorganizacao, $codprojeto, $codmodelo)
    {
        $dados = Regra::dados();
        $organizacao = Organizacao::findOrFail($codorganizacao);
        $projeto = Projeto::findOrFail($codprojeto);
        $modelo = Modelo::findOrFail($codmodelo);
        $tarefas = Tarefa::all();
        return view('controle_regras.create', compact('dados', 'organizacao', 'projeto', 'modelo', 'tarefas'));
    }


    public function store(Request $request)
    {
        $projeto = Projeto::findOrFail($request->codprojeto);
        $organizacao = Organizacao::findOrFail($request->codorganizacao);
        $modelo = Modelo::findOrFail($request->codmodelo);
        if (empty($request->codregra1)){
            $request->request->add([
                'codusuario' => Auth::user()->codusuario,
                'codregra1' => 0
            ]);
        }else{
            $request->request->add([
                'codusuario' => Auth::user()->codusuario
            ]);
        }
        $regra = Regra::create($request->all());
        if (isset($regra)) {
            flash('Regra Criada com sucesso!!!');
        } else {
            flash('Regra Não Foi Criada com sucesso!!!');
        }
        return redirect()->route('controle_regras_index', [
            'codorganizacao' => $organizacao->codorganizacao,
            'codprojeto' => $projeto->codprojeto,
            'codmodelo' => $modelo->codmodelo
        ]);
    }


    public function show($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('controle_tarefas.show', compact('tarefa'));
    }



//'Tarefa 1',
//'Operador',
//'Tarefa 2',
//'Nome da Regra'

    public function edit($id)
    {
        $regra = Regra::findOrFail($id);
        $dados = Regra::dados();
        $dados[0]->valor = $regra->tarefa1->id;
        $dados[1]->valor = $regra->operador;
        $dados[2]->valor = $regra->tarefa2->id;
        $dados[3]->valor = $regra->nome;
        $organizacao = $regra->organizacao;
        $projeto = $regra->projeto;
        $modelo = $regra->modelo;
        $tarefas = TarefaRepository::listar();
        return view('controle_regras.edit', compact('dados', 'regra', 'organizacao', 'projeto', 'modelo', 'tarefas'));
    }


    public function update(Request $request, $codregra)
    {
        $regra = Regra::findOrFail($codregra);
        $regra->update($request->all());
        LogRepository::criar("Regra Atualizada Com sucesso", "Rota De Atualização de Regra");
        if (isset($tarefa)) {
            flash('Regra atualizada com sucesso!!');
        } else {
            flash('Regra não foi atualizada!!');
        }
        return redirect()->route('controle_regras_index', [
            'codorganizacao' => $regra->codorganizacao,
            'codprojeto' => $regra->codprojeto,
            'codmodelo' => $regra->codmodelo
        ]);
    }


    public function destroy($codregra)
    {
        $regra = Regra::findOrFail($codregra);
        $projeto = $regra->projeto;
        $organizacao = $regra->organizacao;
        $modelo = $regra->modelo;
        try {
            $regra->delete();
            LogRepository::criar("Regra Excluída Com sucesso", "Rota De Exclusão de Regra");
            if (!$regra->exists) {
                flash('Regra excluída com sucesso!!');
            } else {
                flash('Regra não foi excluída!!')->warning();
            }
        } catch (\Exception $e) {
            flash('Error!!')->error();
        }
        if (!empty($projeto) || !empty($organizacao) && !empty($modelo)) {
            $titulos = Regra::titulos();
            $regras = Regra::join('users', 'users.id', '=', 'regras.codusuario')->get();
            return view('controle_regras.all', compact('titulos', 'regras'));
        } else {
            return redirect()->route('controle_regras_index', [
                'codorganizacao' => $organizacao->codorganizacao,
                'codprojeto' => $projeto->codprojeto,
                'codmodelo' => $modelo->codmodelo
            ]);
        }

    }
}
