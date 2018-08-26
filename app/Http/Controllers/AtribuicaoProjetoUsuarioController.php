<?php

namespace App\Http\Controllers;

use App\http\Models\AtribuicaoProjetoUsuario;
use App\http\Models\Repositorio;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\ProjetoRepository;
use App\Http\Repositorys\AtribuicaoProjetoUsuarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtribuicaoProjetoUsuarioController extends Controller
{
    public function index($codrepositorio)
    {
        try {
            $repositorio = Repositorio::findOrFail($codrepositorio);
            $atribuicao_projeto_usuarios = $repositorio->atribuicao_projeto_usuarios;
            $titulos = AtribuicaoProjetoUsuario::titulos();
            $tipo = 'atribuicao_projeto_usuario';
            $log = LogRepository::log();
            return view('controle_atribuicao_projeto_usuarios.index', compact('repositorio', 'atribuicao_projeto_usuarios', 'titulos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function todos_grupos()
    {
        try {
            $atribuicao_projeto_usuarios = AtribuicaoProjetoUsuarioRepository::listar();
            $titulos = AtribuicaoProjetoUsuario::titulos();
            $repositorio = Auth::user()->repositorio;
            $tipo = 'atribuicao_projeto_usuario';
            $log = LogRepository::log();
            return view('controle_atribuicao_projeto_usuarios.index', compact('atribuicao_projeto_usuarios', 'titulos', 'tipo', 'log','repositorio'));
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
        $repositorio = (new Repositorio)->where('codrepositorio', '=', $codrepositorio)->first();
        return $repositorio === null;

    }

    public function create($codrepositorio)
    {
        try {
            $dados = AtribuicaoProjetoUsuario::dados();

            if (!$this->exists($codrepositorio)) {
                $repositorio = Repositorio::findOrFail($codrepositorio);
            } else {

                $repositorio = Repositorio::create(['nome' => 'novo', 'descricao' => 'novo']);
            }
            return view('controle_atribuicao_projeto_usuarios.create', compact('dados', 'repositorio'));

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
            $erros = \Validator::make($request->all(), AtribuicaoProjetoUsuario::validacao());
            $codrepositorio = $request->codrepositorio;
            if ($erros->fails()) {
                return redirect()->route('controle_atribuicao_projeto_usuarios_create', [
                    'codrepositorio' => $codrepositorio,
                ])
                    ->withErrors($erros)
                    ->withInput();
            }
            if (!AtribuicaoProjetoUsuarioRepository::atribuicao_projeto_usuario_existe($request->nome)) {
                $atribuicao_projeto_usuario = AtribuicaoProjetoUsuarioRepository::incluir($request);
                flash('Atribuição criada com sucesso!!');
                return redirect()->route('controle_atribuicao_projeto_usuarios_create', [
                    'codrepositorio' => $codrepositorio,
                ]);
            } else {
                $atribuicao_projeto_usuario = AtribuicaoProjetoUsuarioRepository::listar()->where('nome', $request->nome)->first();
                $dados = AtribuicaoProjetoUsuario::dados();
                $repositorio = Repositorio::findOrFail($codrepositorio);
                return view('controle_projetos.create', compact('dados', 'repositorio','atribuicao_projeto_usuario'));
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
    public function show($codatribuicaoprojetousuario)
    {
        try {
            $atribuicao_projeto_usuario = AtribuicaoProjetoUsuario::findOrFail($codatribuicaoprojetousuario);
            echo $atribuicao_projeto_usuario->nome;
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
            $atribuicao_projeto_usuario = AtribuicaoProjetoUsuario::findOrFail($id);
            $dados = AtribuicaoProjetoUsuario::dados();
            $repositorio = $atribuicao_projeto_usuario->repositorio;
            $dados[0]->valor = $atribuicao_projeto_usuario->nome;
            return view('controle_atribuicao_projeto_usuarios.edit', compact('dados', 'atribuicao_projeto_usuario', 'repositorio'));
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
    public function update(Request $request, $codatribuicaoprojetousuario)
    {
        try {
            AtribuicaoProjetoUsuarioRepository::atualizar($request, $codatribuicaoprojetousuario);
            return redirect()->route('controle_atribuicao_projeto_usuarios.edit',[$codatribuicaoprojetousuario]);
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
            $projeto = AtribuicaoProjetoUsuario::findOrFail($codprojeto);
            ProjetoRepository::excluir($codprojeto);
            flash('Operação feita com sucesso!!');
            return redirect()->route('controle_projetos_index', [
                'codrepositorio' => $projeto->codrepositorio,
                'codusuario' => $projeto->codusuario
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
