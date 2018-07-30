<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\BranchsRepository;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Util\Dado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GitController extends Controller
{

    private function funcionalidades()
    {
        return [
            'Merge & checkout',
            'Create & Delete',
            'Commit Branch',
            'Pull & Push Repository',
            'Initialization Repository'
        ];
    }

    private function rotas()
    {
        return [
            'index_merge_checkout',
            'index_create_delete',
            'index_commit_branch',
            'index_pull_push',
            'index_init'
        ];
    }

    public function index_merge_checkout()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.merge_checkout', compact('branch_atual', 'branchs'));
    }

    public function index_create_delete()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.create_delete', compact('branch_atual', 'branchs'));
    }

    public function index_commit_branch()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.commit', compact('branch_atual', 'branchs'));
    }

    public function index_pull_push()
    {
        $branch_atual = 'Em construção';
        return view('controle_versao.pull_push', compact('branch_atual', 'branchs'));
    }

    public function index_init()
    {
        try {
            $branch_atual = 'Em construção';
            $repositorios = GitSistemaRepository::listar_repositorios();

            $tipo = 'repositorio';
            $titulos = [
                'Nome Do Repositório',
                'Nome Completo Do Repositório',
                'Ações'
            ];
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'controle_versao.init';
            $data['acao'] = 'index';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'controle_versao.init';
            $data['acao'] = 'index';
            $this->create_log($data);
        }
        return view('controle_versao.init', compact('tipo', 'branch_atual', 'titulos', 'repositorios'));
    }


    public function index()
    {
        $funcionalidades = [];
        $rotas = self::rotas();
        $dados = self::funcionalidades();
        for ($indice = 0; $indice < 5; $indice++) {
            $funcionalidades[$indice] = new Dado();
            $funcionalidades[$indice]->titulo = $dados[$indice];
            $funcionalidades[$indice]->rota = $rotas[$indice];
        }
        $branch_atual = 'Em construção';

        return view('controle_versao.index', compact('branch_atual', 'funcionalidades'));
    }

    public function selecionar_repositorio($repositorio_atual, $default_branch)
    {
        try {
            
            GitSistemaRepository::selecionar_repositorio($default_branch, $repositorio_atual);
            
            $data['tipo'] = 'success';
            $this->create_log($data);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error!';
            $data['pagina'] = 'controle_versao.init';
            $data['acao'] = 'selecionar_repositorio';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error!';
            $data['pagina'] = 'controle_versao.init';
            $data['acao'] = 'selecionar_repositorio';
            $this->create_log($data);

        }
        return redirect()->route('controle_versao.show', ['nome_repositorio' => $repositorio_atual]);
    }

    public function init(Request $request)
    {
        try {
            $repositorio = GitSistemaRepository::create_repository($request->nome);
            GitSistemaRepository::atualizar_usuario_github($repositorio);
            return redirect()->route('controle_versao.show', ['nome_repositorio' => $request->nome]);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'controle_versao.init';
            $data['acao'] = 'init';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'controle_versao.init';
            $data['acao'] = 'init';
            $this->create_log($data);
        }
        return redirect()->route('index_init');

    }

    public function show($nome_repositorio)
    {
        try {
            $repositorio = GitSistemaRepository::get_repositorio('jeancarlos2015', $nome_repositorio);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'controle_versao.show';
            $data['acao'] = 'show';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'controle_versao.show';
            $data['acao'] = 'show';
            $this->create_log($data);
        }
        return view('controle_versao.show', compact('tipo', 'branch_atual', 'repositorio'));

    }

    public function delete_repository($repositorio_atual)
    {
        try {
            GitSistemaRepository::delete_repository($repositorio_atual);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'delete_repository';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'delete_repository';
            $this->create_log($data);
        }
        return redirect()->route('index_init');
    }

    public function edit_repository(Request $request)
    {
        dd($request);
    }

    public function delete(Request $request)
    {
        try {

            BranchsRepository::excluir_branch($request->branch);
            $data['tipo'] = 'success';
            $this->create_log($data);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'delete';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'delete';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    public function create(Request $request)
    {
        try {
//            GitSistemaRepository::create_branch($request->branch);
            $request->request->add([
                'descricao' => 'nenhum',
                'codusuario' => Auth::user()->codusuario
            ]);
            BranchsRepository::incluir($request->all());
            $data['tipo']='success';
            $this->create_log($data);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'create';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'create';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }

    /* Atualizar_todas_branchs: -deleta as branchs que existem no banco de acordo com o repositório fornecido.
                                -busca todas as branchs que existem no repositório fornecido.
                                -Inclui as branchs no banco.

       Pull:                    -Verifica se existem arquivos locais, baixa os arquivos que existem no repositório
                                -Atualiza os arquivos locais de acordo com o repositório e a branch fornecida
     *
     *
     */
    public function pull()
    {
        try {
            GitSistemaRepository::pull(Auth::user()->github->branch_atual);
            $data['tipo'] = 'success';
            $this->create_log($data);
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'pull';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'pull';
            $this->create_log($data);
        }

        return redirect()->route('painel');
    }


    public function merge_checkout(Request $request)
    {
        try {
            $validate = [
                'branch',
                'tipo'
            ];
            $erros = \Validator::make($request->all(), $validate);
            if ($erros->fails()) {
                return redirect()->route('painel')
                    ->withErrors($erros)
                    ->withInput();
            } else {
                GitSistemaRepository::merge_checkout($request->tipo, $request->branch);
                $data['tipo'] = 'success';
                $this->create_log($data);

            }

        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'merge_checkout';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


    public function commit(Request $request)
    {
        try {
            
            GitSistemaRepository::commit($request->commit);
            flash('Operação feita com sucesso !!!');
        } catch (\Exception $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'commit';
            $this->create_log($data);
        } catch (ApiLimitExceedException $ex) {
            $data['mensagem'] = $ex->getMessage();
            $data['tipo'] = 'error';
            $data['pagina'] = 'Painel';
            $data['acao'] = 'commit';
            $this->create_log($data);
        }
        return redirect()->route('painel');
    }


}
