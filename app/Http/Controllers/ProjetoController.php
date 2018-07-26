<?php

namespace App\Http\Controllers;

use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ProjetoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetoController extends Controller
{


    public function index($codorganizacao)
    {
        try {
            $organizacao = Organizacao::findOrFail($codorganizacao);
            $projetos = ProjetoRepository::listar_por_organizacao($codorganizacao);
            $titulos = Projeto::titulos();
            $tipo = 'projeto';
            $log = LogRepository::log();
            return view('controle_projetos.index', compact('organizacao', 'projetos', 'titulos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_projetos.index',
                'index');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }

    public function todos_projetos()
    {
        try {
            $projetos = ProjetoRepository::listar();
            $titulos = Projeto::titulos();
            $tipo = 'projeto';
            $log = LogRepository::log();
            return view('controle_projetos.index', compact('projetos', 'titulos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_projetos.index',
                'todos_projetos');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return bool
     */
    private function exists($codorganizacao)
    {
        $organizacao = (new Organizacao)->where('codorganizacao', '=', $codorganizacao)->first();
        return $organizacao === null;

    }

    public function create($codorganizacao)
    {
        try {
            $dados = Projeto::dados();
            if (!$this->exists($codorganizacao)) {
                $organizacao = Organizacao::findOrFail($codorganizacao);
            } else {
                $organizacao = Organizacao::create(['nome' => 'novo', 'descricao' => 'novo']);
            }

            return view('controle_projetos.create', compact('dados', 'organizacao'));
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_projetos.create',
                'create');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }


    public function store(Request $request)
    {
        try {
            $codorganizacao = $request->codorganizacao;
            $erros = \Validator::make($request->all(), Projeto::validacao());
            if ($erros->fails()) {
                return redirect()->route('controle_projeto_create', [
                    'codorganizacao' => $codorganizacao,
                ])
                    ->withErrors($erros)
                    ->withInput();
            }

            $request->request->add(['codusuario' => Auth::user()->codusuario]);
            $projeto = Projeto::create($request->all());
            flash('Projeto criado com sucesso!!');
            return redirect()->route('controle_modelos_index', ['codorganizacao' => $codorganizacao, 'codprojeto' => $projeto->codprojeto]);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_projetos.create',
                'store');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function show($codprojeto)
    {
        try {
            $projeto = Projeto::findOrFail($codprojeto);
            return redirect()->route('controle_modelos_index', ['codorganizacao' => $projeto->codorganizacao, 'codprojeto' => $codprojeto]);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_modelos.index',
                'show');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $projeto = Projeto::findOrFail($id);
            $dados = Projeto::dados();
            $organizacao = $projeto->organizacao;
            $dados[0]->valor = $projeto->nome;
            $dados[1]->valor = $projeto->descricao;
            return view('controle_projetos.edit', compact('dados', 'projeto', 'organizacao'));
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_projetos.edit',
                'edit');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Projeto $projeto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $codprojeto)
    {
        try {
            $projeto = ProjetoRepository::atualizar($request, $codprojeto);
            return redirect()->route('controle_modelos_index', ['codorganizacao' => $projeto->codorganizacao, 'codprojeto' => $codprojeto]);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_modelos.edit',
                'update');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');

    }


    public function destroy($codprojeto)
    {
        try {
            $projeto = Projeto::findOrFail($codprojeto);
            ProjetoRepository::excluir($codprojeto);
            return redirect()->route('controle_projetos_index', [
                'codorganizacao' => $projeto->codorganizacao
            ]);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_projetos.index',
                'destroy');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        }
        return redirect()->route('painel');
    }
}
