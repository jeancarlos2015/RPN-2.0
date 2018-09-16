<?php

namespace App\Http\Fachadas;

use App\http\Models\Repositorio;
use App\Http\Repositorys\BranchsRepository;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\RepositorioRepository;
use App\Http\Util\ValidacaoLogErros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FachadaRepositorio extends FachadaConcreta
{

    public static function selecionar_repositorio($dado)
    {
        if (Auth::user()->email==='jeancarlospenas25@gmail.com'){
            $repositorio_atual = $dado['repositorio_atual'];
            $default_branch = $dado['default_branch'];
            GitSistemaRepository::selecionar_repositorio($default_branch, $repositorio_atual);
        }else{
            $repositorio_atual = $dado['repositorio_atual'];
            $default_branch = $dado['default_branch'];
            GitSistemaRepository::selecionar_repositorio($default_branch, $repositorio_atual);
            $branch_rascunho = [
                'branch' => 'rascunho',
                'descricao' => 'rascunho',
                'cod_usuario' => Auth::user()->cod_usuario
            ];
            $branch_original = [
                'branch' => 'original',
                'descricao' => 'original',
                'cod_usuario' => Auth::user()->cod_usuario
            ];
            BranchsRepository::incluir($branch_original);
            sleep(2);
            BranchsRepository::incluir($branch_rascunho);
            GitSistemaRepository::merge_checkout('checkout', 'rascunho');
        }

    }

    public function index($codigo1 = null, $codigo2 = null)
    {
        try {
            $repositorios = RepositorioRepository::listar();
            $titulos = Repositorio::titulos_da_tabela();
            $campos = Repositorio::campos();
            $tipo = 'repositorio';
            $log = LogRepository::log();
            return view('controle_repositorios.index', compact('repositorios', 'titulos', 'campos', 'tipo', 'log'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'index';
            ValidacaoLogErros::create_log($data);
        }
    }


    public function create(Request $request = null, $codigo = null)
    {
        $dados = Repositorio::dados();
        return view('controle_repositorios.create', compact('dados'));
    }



    public function store(Request $request)
    {
        try {

            $erros = \Validator::make($request->all(), Repositorio::validacao());
            if ($erros->fails()) {
                return redirect()->route('controle_repositorios.create')
                    ->withErrors($erros)
                    ->withInput();
            }
            if (!RepositorioRepository::repositorio_existe($request->nome)) {

                $repositorio = RepositorioRepository::incluir($request);

                if (isset($repositorio)) {
                    flash('Organização criada com sucesso!!');
                } else {
                    flash('Organização não foi criada!!');
                }

                return redirect()->route('controle_projetos_index',
                    [
                        'cod_repositorio' => $repositorio->cod_repositorio
                    ]
                );
            } else {

                $dados = Repositorio::dados();
                $repositorio = RepositorioRepository::listar()->where('nome', $request->nome)->first();
                return view('controle_repositorios.create', compact('dados','repositorio'));
            }

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'store';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function show($codrepositorio = null)
    {
        return redirect()->route('controle_projetos_index',
            [
                'cod_repositorio' => $codrepositorio
            ]
        );
    }


    public function edit($id)
    {
        try {
            $repositorio = Repositorio::findOrFail($id);
            $dados = Repositorio::dados();
            $dados[0]->valor = $repositorio->nome;
            $dados[1]->valor = $repositorio->descricao;
            return view('controle_repositorios.edit', compact('dados', 'repositorio'));
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'edit';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function update(Request $request, $codrepositorio = null)
    {
        try {
            $repositorio = RepositorioRepository::atualizar($request, $codrepositorio);
            if (isset($repositorio)) {
                flash('Organização Atualizada com sucesso!!');
            } else {
                flash('Organização não foi Atualizada!!');
            }
            return redirect()->route('controle_repositorios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'update';
            ValidacaoLogErros::create_log($data);
        }
        return redirect()->route('painel');
    }


    public function destroy($codrepositorio)
    {
        try {
            RepositorioRepository::excluir($codrepositorio);
            flash('Operação feita com sucesso!!');
            return response()->redirectToRoute('controle_repositorios.index');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'destroy';
            ValidacaoLogErros::create_log($data);
        }
    }

}
