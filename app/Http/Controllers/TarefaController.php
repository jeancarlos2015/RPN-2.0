<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;
use App\Http\Models\Tarefa;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\TarefaRepository;
use Illuminate\Http\Request;

class TarefaController extends Controller
{

    public function index($codorganizacao, $codprojeto, $codmodelo)

    {
        try {
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
            return view('controle_tarefas.index', compact('tarefas', 'titulos', 'organizacao', 'projeto', 'modelo', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function todas_tarefas()
    {
        try {
            $tarefas = TarefaRepository::listar();
            $titulos = Tarefa::titulos();
            $tipo = 'tarefa';
            $log = LogRepository::log();
            return view('controle_tarefas.all', compact('tarefas', 'titulos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function create($codorganizacao, $codprojeto, $codmodelo, $codregra)
    {
        try {
            $dados = Projeto::dados();
            $organizacao = Organizacao::findOrFail($codorganizacao);
            $projeto = Projeto::findOrFail($codprojeto);
            $modelo = Modelo::findOrFail($codmodelo);
            $regra = Regra::findOrFail($codregra);
            return view('controle_tarefas.form_tarefa', compact('dados', 'organizacao', 'projeto', 'modelo', 'regra'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function store(Request $request)
    {
        try {
            $projeto = Projeto::findOrFail($request->codprojeto);
            $organizacao = Organizacao::findOrFail($request->codorganizacao);
            $modelo = Modelo::findOrFail($request->codmodelo);


            if (isset($tarefa1) && isset($tarefa1)) {
                flash('Regra criada com sucesso!!');
            } else {
                flash('Regra não foi criada!!');
            }
            return redirect()->route('controle_regras_index', [
                'codorganizacao' => $organizacao->codorganizacao,
                'codprojeto' => $projeto->codprojeto,
                'codmodelo' => $modelo->codmodelo
            ]);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function show($codtarefa)
    {
        try {
            $tarefa = Tarefa::findOrFail($codtarefa);
            return view('controle_tarefas.show', compact('tarefa'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function edit($codtarefa)
    {
        try {
            $tarefa = Tarefa::findOrFail($codtarefa);
            $dados = Tarefa::dados();
            $dados[0]->valor = $tarefa->nome;
            $dados[1]->valor = $tarefa->descricao;
            return view('controle_tarefas.edit', compact('dados', 'tarefa'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $codtarefa)
    {
        try {
            $tarefa = Tarefa::findOrFail($codtarefa);
            $tarefa->update($request->all());
            flash('Tarefa atualizada com sucesso!!');

            return redirect()->route('controle_tarefas_index', [
                'codorganizacao' => $tarefa->codorganizacao,
                'codprojeto' => $tarefa->codprojeto,
                'codmodelo' => $tarefa->codmodelo
            ]);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($id)
    {
        try {
            $tarefa = Tarefa::findOrFail($id);
            $projeto = $tarefa->projeto;
            $organizacao = $tarefa->organizacao;
            $modelo = $tarefa->modelo;
            $tarefa->delete();
            flash('Operação feita com sucesso!!');


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
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }
}
