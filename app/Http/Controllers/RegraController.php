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
//        try {
//            $dado['codorganizacao'] = $codorganizacao;
//            $dado['codprojeto'] = $codprojeto;
//            $dado['codmodelo'] = $codmodelo;
//            $organizacao = Organizacao::findOrFail($codorganizacao);
//            $projeto = Projeto::findOrFail($codprojeto);
//            $modelo = Modelo::findOrFail($codmodelo);
//            return redirect()->route('controle_regras_create',
//                [
//                    'codorganizacao' => $organizacao->codorganizacao,
//                    'codprojeto' => $projeto->codprojeto,
//                    'codmodelo' => $modelo->codmodelo
//
//                ]);
//        } catch (\Exception $ex) {
//            $data['mensagem'] = $ex->getMessage();
//            $data['tipo'] = 'error';
//            $data['pagina'] = 'Painel';
//            $data['acao'] = 'merge_checkout';
//            $this->create_log($data);
//        }
//        return redirect()->route('painel');
        return view('controle_tarefas.aviso');
    }

    public function todas_regras()
    {
//        try {
//            $regras = RegraRepository::listar();
//            $titulos = Regra::titulos();
//            $tarefas = null;
//            $tipo = 'regra';
//            dd($regras);
//            return view('controle_regras.all', compact('regras', 'titulos', 'tarefas', 'tipo'));
//        } catch (\Exception $ex) {
//            $data['mensagem'] = $ex->getMessage();
//            $data['tipo'] = 'error';
//            $data['pagina'] = 'Painel';
//            $data['acao'] = 'merge_checkout';
//            $this->create_log($data);
//        }
//        return redirect()->route('painel');
        return view('controle_tarefas.aviso');
    }

    public function create($codorganizacao, $codprojeto, $codmodelo)
    {
        try {
            $organizacao = Organizacao::findOrFail($codorganizacao);
            $projeto = Projeto::findOrFail($codprojeto);
            $modelo = Modelo::findOrFail($codmodelo);
            $regras = RegraRepository::listar();
            $tarefas = TarefaRepository::listar();
            $titulos = Regra::titulos();
            $tipo = 'regra';
            return view('controle_regras.form_regra', compact('organizacao', 'projeto', 'modelo', 'titulos', 'regras', 'tipo', 'tarefas'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    private function adiciona_request(Request $request)
    {
        if (empty($request->codregra1)) {
            $request->request->add([
                'codusuario' => Auth::user()->codusuario,
                'codregra1' => 0
            ]);
        } else {
            $request->request->add([
                'codusuario' => Auth::user()->codusuario
            ]);
        }
    }

    private function msg($regra)
    {
        if (isset($regra)) {
            flash('Regra Criada com sucesso!!!');
        } else {
            flash('Regra Não Foi Criada com sucesso!!!');
        }
    }

    private function set_param_tarefa1(Request $request, Regra $regra)
    {
        return [
            'nome' => $request->tarefa1_nome,
            'descricao' => $request->tarefa1_descricao,
            'codregra' => $regra->codregra,
            'codmodelo' => $regra->codmodelo,
            'codprojeto' => $regra->codprojeto,
            'codorganizacao' => $regra->codorganizacao,
            'codusuario' => $regra->codusuario
        ];
    }

    private function set_param_regra(Request $request)
    {
        return [
            'nome' => $request->nome,
            'operador' => $request->operador,
            'codmodelo' => $request->codmodelo,
            'codprojeto' => $request->codprojeto,
            'codorganizacao' => $request->codorganizacao,
            'codusuario' => Auth::user()->codusuario,
            'codregra1' => 0
        ];
    }

    private function set_param_tarefa2(Request $request, Regra $regra)
    {
        return [
            'nome' => $request->tarefa2_nome,
            'descricao' => $request->tarefa2_descricao,
            'codregra' => $regra->codregra,
            'codmodelo' => $regra->codmodelo,
            'codprojeto' => $regra->codprojeto,
            'codorganizacao' => $regra->codorganizacao,
            'codusuario' => $regra->codusuario
        ];
    }


    private function create_tarefas_redireciona($regra, Request $request)
    {
        if (count($regra->tarefas) == 0) {
            $tarefa1 = Tarefa::create(self::set_param_tarefa1($request, $regra));
            $tarefa2 = Tarefa::create(self::set_param_tarefa2($request, $regra));
            self::msg("Regra Criada com sucesso");
        } else {
            self::msg("Atingiu o limite máximo para essa regra");
        }
    }

//    private function valida_erros(Request $request, $codorganizacao, $codprojeto, $codmodelo)
//    {
//        $erros = \Validator::make($request->all(), Regra::validacao());
//        if ($erros->fails()) {
//            return redirect()->route('controle_regras_create', [
//                'codorganizacao' => $codorganizacao,
//                'codprojeto' => $codprojeto,
//                'codmodelo' => $codmodelo
//            ])
//                ->withErrors($erros)
//                ->withInput();
//        }
//    }



    private function verifica_se_existe_e_cria_regra_auxiliar($data1)
    {
        $nome = $data1['nome'];
        $tipo = $data1['tipo'];
        $codorganizacao = $data1['codorganizacao'];
        $codprojeto = $data1['codprojeto'];
        $codmodelo = $data1['codmodelo'];
        if ($tipo === 'regra') {
            if (!RegraRepository::regra_existe($nome)) {

                $operador = $data1['operador'];

                $data = [
                    'codusuario' => Auth::user()->codusuario,
                    'nome' => $nome,
                    'operador' => $operador,
                    'codregra1' => 0,
                    'codorganizacao' => $codorganizacao,
                    'codprojeto' => $codprojeto,
                    'codmodelo' => $codmodelo,
                ];
               return RegraRepository::incluir($data);

            } else {
                $regra = RegraRepository::busca_regra_por_nome($nome);
                $operador = $data1['operador'];
                $data = [
                    'codusuario' => Auth::user()->codusuario,
                    'nome' => $nome,
                    'operador' => $operador,
                    'codregra1' => $regra->codregra,
                    'codorganizacao' => $codorganizacao,
                    'codprojeto' => $codprojeto,
                    'codmodelo' => $codmodelo,
                ];
               return  RegraRepository::incluir($data);
            }
        }
    }
//nome',
//        'descricao',
//        'codorganizacao',
//        'codprojeto',
//        'codmodelo',
//        'codusuario',
//        'codregra'
    private function verificar_se_existe_e_cria_tarefa_auxiliar($data1)
    {

        $nome = $data1['nome'];
        $tipo = $data1['tipo'];
        $codorganizacao = $data1['codorganizacao'];
        $codprojeto = $data1['codprojeto'];
        $codmodelo = $data1['codmodelo'];
        $codregra = $data1['codregra'];
        if ($tipo === 'tarefa') {

            if (!TarefaRepository::tarefa_existe($nome)) {
                $data = [
                    'codusuario' => Auth::user()->codusuario,
                    'nome' => $nome,
                    'descricao' => 'Nenhum',
                    'codorganizacao' => $codorganizacao,
                    'codprojeto' => $codprojeto,
                    'codmodelo' => $codmodelo,
                    'codregra' => $codregra
                ];
                TarefaRepository::incluir($data);
            }
        }

    }


    public function store(Request $request)
    {
//        try {
//
//            $data['all'] = $request->all();
//            $data['validacao'] = Regra::validacao();
//            $codorganizacao = $request->codorganizacao;
//            $codprojeto = $request->codprojeto;
//            $codmodelo = $request->codmodelo;
//
//            if (!$this->exists_errors($data)) {
//
//                $dado['codorganizacao'] = $codorganizacao;
//                $dado['codprojeto'] = $codprojeto;
//                $dado['codmodelo'] = $codmodelo;
//
//                $dado['tipo'] = $request->tipo1;
//                $dado['nome'] = $request->tarefa_ou_regra1;
//                $dado['operador'] = $request->operador;
//                $regra = $this->verifica_se_existe_e_cria_regra_auxiliar($dado);
//                if (!empty($regra)){
//                    $dado['codregra'] = $regra->codregra;
//                }
//
//                $this->verificar_se_existe_e_cria_tarefa_auxiliar($dado);
//
//
//                $dado['tipo'] = $request->tipo2;
//                $dado['nome'] = $request->tarefa_ou_regra2;
//                $regra2 = $this->verifica_se_existe_e_cria_regra_auxiliar($dado);
//                $this->verificar_se_existe_e_cria_tarefa_auxiliar($dado);
//
//
//                return redirect()->route('controle_regras_create', [
//                    'codorganizacao' => $codorganizacao,
//                    'codprojeto' => $codprojeto,
//                    'codmodelo' => $codmodelo
//                ]);
//            }
//
//            $data['rota'] = 'controle_regras_create';
//            $data['erros'] = $this->get_errors($data);
//            $this->validar($data);
//        } catch (\Exception $ex) {
//            $data['mensagem'] = $ex->getMessage();
//            $data['tipo'] = 'error';
//            $data['pagina'] = 'Painel';
//            $data['acao'] = 'merge_checkout';
//            $this->create_log($data);
//        }
//        return redirect()->route('painel');
        return view('controle_tarefas.aviso');
    }

    public function show($id)
    {
//        try {
//            $tarefa = Tarefa::findOrFail($id);
//            return view('controle_tarefas.show', compact('tarefa'));
//        } catch (\Exception $ex) {
//            $data['mensagem'] = $ex->getMessage();
//            $data['tipo'] = 'error';
//            $data['pagina'] = 'Painel';
//            $data['acao'] = 'merge_checkout';
//            $this->create_log($data);
//        }
//        return redirect()->route('painel');
        return view('controle_tarefas.aviso');
    }

    public function edit($id)
    {
//        try {
//            $regra = Regra::findOrFail($id);
//            $dados = Regra::dados();
//            $dados[0]->valor = $regra->tarefas[0]->codtarefa;
//            $dados[1]->valor = $regra->operador;
//            $dados[2]->valor = $regra->tarefas[1]->codtarefa;
//            $dados[3]->valor = $regra->nome;
//            $organizacao = $regra->organizacao;
//            $projeto = $regra->projeto;
//            $modelo = $regra->modelo;
//            $tarefas = TarefaRepository::listar();
//            return view('controle_regras.edit', compact('dados', 'regra', 'organizacao', 'projeto', 'modelo', 'tarefas'));
//        } catch (\Exception $ex) {
//            $data['mensagem'] = $ex->getMessage();
//            $data['tipo'] = 'error';
//            $data['pagina'] = 'Painel';
//            $data['acao'] = 'merge_checkout';
//            $this->create_log($data);
//        }
//        return redirect()->route('painel');
        return view('controle_tarefas.aviso');
    }


    public function update(Request $request, $codregra)
    {
//        try {
//            $regra = Regra::findOrFail($codregra);
//            $regra->update($request->all());
//            flash('Regra atualizada com sucesso!!');
//
//            return redirect()->route('controle_regras_index', [
//                'codorganizacao' => $regra->codorganizacao,
//                'codprojeto' => $regra->codprojeto,
//                'codmodelo' => $regra->codmodelo
//            ]);
//        } catch (\Exception $ex) {
//            $data['mensagem'] = $ex->getMessage();
//            $data['tipo'] = 'error';
//            $data['pagina'] = 'Painel';
//            $data['acao'] = 'merge_checkout';
//            $this->create_log($data);
//        }
//        return redirect()->route('painel');
        return view('controle_tarefas.aviso');
    }


    public function destroy($codregra)
    {
//        try {
//            $regra = Regra::findOrFail($codregra);
//            $projeto = $regra->projeto;
//            $organizacao = $regra->organizacao;
//            $modelo = $regra->modelo;
//
//            $regra->delete();
//
//
//            flash('Regra excluída com sucesso!!');
//
//
//            if (!empty($projeto) || !empty($organizacao) && !empty($modelo)) {
//                $titulos = Regra::titulos();
//
//                $regras = RegraRepository::listar();
//                $tipo = 'regra';
//                return view('controle_regras.all', compact('titulos', 'regras', 'tipo'));
//            } else {
//                return redirect()->route('controle_regras_index', [
//                    'codorganizacao' => $organizacao->codorganizacao,
//                    'codprojeto' => $projeto->codprojeto,
//                    'codmodelo' => $modelo->codmodelo
//                ]);
//            }
//        } catch (\Exception $ex) {
//            $data['mensagem'] = $ex->getMessage();
//            $data['tipo'] = 'error';
//            $data['pagina'] = 'Painel';
//            $data['acao'] = 'merge_checkout';
//            $this->create_log($data);
//        }
//        return redirect()->route('painel');
        return view('controle_tarefas.aviso');
    }
}
