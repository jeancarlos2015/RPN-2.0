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
            $titulos = Projeto::titulos_da_tabela();
            $tipo = 'projeto';
            $log = LogRepository::log();
            return view('controle_projetos.index', compact('organizacao', 'projetos', 'titulos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function todos_projetos()
    {
        try {
            $projetos = ProjetoRepository::listar();
            $titulos = Projeto::titulos_da_tabela();
            $tipo = 'projeto';
            $log = LogRepository::log();
            return view('controle_projetos.index', compact('projetos', 'titulos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
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
            $codorganizacao = $request->codorganizacao;
            $erros = \Validator::make($request->all(), Projeto::validacao());
            if ($erros->fails()) {
                return redirect()->route('controle_projeto_create', [
                    'codorganizacao' => $codorganizacao,
                ])
                    ->withErrors($erros)
                    ->withInput();
            }
            if(!ProjetoRepository::projeto_existe($request->nome)){
                $request->request->add(['codusuario' => Auth::user()->codusuario]);
                $projeto = Projeto::create($request->all());
                flash('Projeto criado com sucesso!!');
                return redirect()->route('controle_modelos_index', ['codorganizacao' => $codorganizacao, 'codprojeto' => $projeto->codprojeto]);
            }else{
                $data['tipo'] = 'existe';
                $this->create_log($data);
                return redirect()->route('controle_projetos_create',
                    [
                        'codorganizacao' =>  $codorganizacao
                    ]
                );
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
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
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
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
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
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');

    }


    public function destroy($codprojeto)
    {
        try {
            $projeto = Projeto::findOrFail($codprojeto);
            ProjetoRepository::excluir($codprojeto);
            flash('Operação feita com sucesso!!');
            return redirect()->route('controle_projetos_index', [
                'codorganizacao' => $projeto->codorganizacao
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
}
