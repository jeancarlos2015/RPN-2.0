<?php

namespace App\Http\Controllers;

use App\Http\Models\Repositorio;
use App\Http\Models\Projeto;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ProjetoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetoController extends Controller
{


    public function index($codrepositorio)
    {
        try {
            $repositorio = Repositorio::findOrFail($codrepositorio);
//            $projetos = ProjetoRepository::listar_por_repositorio($codrepositorio);
            $projetos = $repositorio->projetos;
            $titulos = Projeto::titulos_da_tabela();
            $tipo = 'projeto';
            $log = LogRepository::log();
            return view('controle_projetos.index', compact('repositorio', 'projetos', 'titulos', 'tipo', 'log'));
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
            $repositorio = Auth::user()->repositorio;
            $tipo = 'projeto';
            $log = LogRepository::log();
            return view('controle_projetos.index', compact('projetos', 'titulos', 'tipo', 'log','repositorio'));
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
    private function exists($codrepositorio)
    {
        $repositorio = (new Repositorio)->where('cod_repositorio', '=', $codrepositorio)->first();
        return $repositorio === null;

    }

    public function create($codrepositorio)
    {
        try {
            $dados = Projeto::dados();

                if (!$this->exists($codrepositorio)) {
                    $repositorio = Repositorio::findOrFail($codrepositorio);
                } else {

                    $repositorio = Repositorio::create(['nome' => 'novo', 'descricao' => 'novo']);
                }
                return view('controle_projetos.create', compact('dados', 'repositorio'));

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
            $erros = \Validator::make($request->all(), Projeto::validacao());
            $codrepositorio = $request->cod_repositorio;
            if ($erros->fails()) {
                return redirect()->route('controle_projeto_create', [
                    'cod_repositorio' => $codrepositorio,
                ])
                    ->withErrors($erros)
                    ->withInput();
            }
            if (!ProjetoRepository::projeto_existe($request->nome)) {
                $request->request->add(['cod_usuario' => Auth::user()->cod_usuario]);
                $projeto = ProjetoRepository::incluir($request);
                flash('Projeto criado com sucesso!!');
                return redirect()->route('controle_modelos_diagramaticos_index',
                    [
                        'cod_repositorio' => $codrepositorio,
                        'cod_projeto' => $projeto->cod_projeto,
                        'cod_usuario' => $projeto->cod_usuario
                    ]
                );
            } else {
                $projeto = ProjetoRepository::listar()->where('nome', $request->nome)->first();
                $dados = Projeto::dados();
                $repositorio = Repositorio::findOrFail($codrepositorio);
                return view('controle_projetos.create', compact('dados', 'repositorio','projeto'));
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

            return redirect()->route('controle_modelos_diagramaticos_index',
                [
                    'cod_repositorio' => $projeto->cod_repositorio,
                    'cod_projeto' => $codprojeto,
                    'cod_usuario' => $projeto->cod_usuario
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
            $repositorio = $projeto->repositorio;
            $dados[0]->valor = $projeto->nome;
            $dados[1]->valor = $projeto->descricao;
            return view('controle_projetos.edit', compact('dados', 'projeto', 'repositorio'));
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
            return redirect()->route('controle_modelos_diagramaticos_index',
                [
                    'cod_repositorio' => $projeto->cod_repositorio,
                    'cod_projeto' => $codprojeto,
                    'cod_usuario' => $projeto->cod_usuario
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


    public function destroy($codprojeto)
    {
        try {
            $projeto = Projeto::findOrFail($codprojeto);
            ProjetoRepository::excluir($codprojeto);
            flash('Operação feita com sucesso!!');
            return redirect()->route('controle_projetos_index', [
                'cod_repositorio' => $projeto->cod_repositorio,
                'cod_usuario' => $projeto->cod_usuario
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
