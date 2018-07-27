<?php

namespace App\Http\Controllers;

use App\Http\Models\Branchs;
use App\Http\Models\UsuarioGithub;
use App\Http\Repositorys\BranchsRepository;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Repositorys\OrganizacaoRepository;
use App\Http\Util\Dado;
use Github\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_versao.init',
                'listagem de repositórios');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'controle_versao.init',
                'listagem de repositórios'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
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
            $client = new Client();
            $github = Auth::user()->github;

            $client->authenticate(Crypt::decrypt($github->usuario_github), Crypt::decrypt($github->senha_github));

            $branchs = $client->repo()->branches(Crypt::decrypt($github->usuario_github), $repositorio_atual);
            //Ao selecionar um outro repositório é necessário atualizar a base de dados, então quanto a operação é feita
            //é necessário deletar todas as branchs do antigo repositório
            BranchsRepository::excluir_todos();
            //Busca as branchs do repositório que está no github e salva na base de dados;

            foreach ($branchs as $branch) {
                $data = [
                    'branch' => $branch['name'],
                    'descricao' => 'Nenhum',
                    'codusuario' => Auth::user()->codusuario
                ];
                (new Branchs)->create($data);
            }
            //Informações pertinentes aos registros do banco do repositório antigo também são apagados
            OrganizacaoRepository::excluir_todos();

            GitSistemaRepository::apaga_modelos();
            GitSistemaRepository::change_branch($repositorio_atual, $default_branch);
            GitSistemaRepository::pull($default_branch);


        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_versao.init',
                'selecionar_repositorio');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'controle_versao.init',
                'selecionar_repositorio'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
        }
        return redirect()->route('controle_versao.show', ['nome_repositorio' => $repositorio_atual]);
    }

    public function init(Request $request)
    {
        try {
            $repositorio = GitSistemaRepository::create_repository($request->nome);
            $github_data = Auth::user()->github;
            $user_github = UsuarioGithub::findOrFail($github_data->codusuariogithub);
            $data = [
                'codusuario' => Auth::user()->codusuario,
                'email_github' => $github_data->email_github,
                'senha_github' => $github_data->senha_github,
                'branch_atual' => $repositorio['default_branch'],
                'repositorio_atual' => $repositorio['name']
            ];
            $user_github->update($data);
            return redirect()->route('controle_versao.show', ['nome_repositorio' => $request->nome]);

        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_versao.init',
                'init');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'controle_versao.init',
                'init'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
        }
        return redirect()->route('index_init');

    }

    public function show($nome_repositorio)
    {
        try {
            $repositorio = GitSistemaRepository::get_repositorio('jeancarlos2015', $nome_repositorio);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'controle_versao.show',
                'show');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'controle_versao.show',
                'show'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
        }
        return view('controle_versao.show', compact('tipo', 'branch_atual', 'repositorio'));

    }

    public function delete_repository($repositorio_atual, $default_branch)
    {
        try {
            GitSistemaRepository::delete_repository($repositorio_atual);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'Painel',
                'create');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'Painel',
                'delete_repository'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
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
            if (GitSistemaRepository::delete_branch($request->branch) === 204) {
                $branchs = Branchs::all()->where('branch', '=', $request->branch);
                foreach ($branchs as $b) {
                    $codbranch = $b->codbranch;
                    BranchsRepository::excluir($codbranch);
                }
            }
            flash('Branch deletada com sucesso!!!');
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'Painel',
                'delete');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
            BranchsRepository::excluir_branch($request->branch);
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'Painel',
                'delete'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
        }
        return redirect()->route('painel');
    }

    public function create(Request $request)
    {
        try {
            GitSistemaRepository::create_branch($request->branch);
            $data_branch = [
                'branch' => $request->branch,
                'descricao' => 'Nenhum',
                'codusuario' => Auth::user()->codusuario
            ];
            Branchs::create($data_branch);
            GitSistemaRepository::checkout($request->branch);
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'Painel',
                'create');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'Painel',
                'create'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
        }
        return redirect()->route('painel');
    }


    public function pull()
    {
        try {
            GitSistemaRepository::pull(Auth::user()->github->branch_atual);
            flash('Operação Feita com sucesso!!!');
        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'Painel',
                'pull');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'Painel',
                'pull'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
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
                if ($request->tipo === 'checkout') {
                    GitSistemaRepository::checkout($request->branch);
                } elseif ($request->tipo === 'merge') {
                    GitSistemaRepository::merge($request->branch);
                }
                flash('Operação Feita com sucesso');

            }

        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'Painel',
                'merge_checkout');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'Painel',
                'merge_checkout'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
        }
        return redirect()->route('painel');
    }


    public function commit(Request $request)
    {
        try {
            GitSistemaRepository::commit($request->commit);
            flash('Operação feita com sucesso !!!');


        } catch (\Exception $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'warning',
                'Painel',
                'commit');
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->warning();
        } catch (ApiLimitExceedException $ex) {
            $codigo = LogRepository::criar(
                $ex->getMessage(),
                'error',
                'Painel',
                'commit'
            );
            flash('Atenção - Log Número ' . $codigo . " Favor consultar no Logs do Sistema")->error();
        }
        return redirect()->route('painel');
    }


}
