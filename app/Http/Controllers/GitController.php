<?php

namespace App\Http\Controllers;

use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Util\Dado;
use App\Http\Util\GitComando;
use Cz\Git\GitException;
use Illuminate\Http\Request;

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
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.merge_checkout', compact('branch_atual', 'branchs'));
    }

    public function index_create_delete()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.create_delete', compact('branch_atual', 'branchs'));
    }

    public function index_commit_branch()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.commit', compact('branch_atual', 'branchs'));
    }

    public function index_pull_push()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.pull_push', compact('branch_atual', 'branchs'));
    }

    public function index_init()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        return view('controle_versao.init', compact('tipo', 'branch_atual'));
    }

    public function index()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $funcionalidades = [];
        $rotas = self::rotas();
        $dados = self::funcionalidades();
        for ($indice = 0; $indice < 5; $indice++) {
            $funcionalidades[$indice] = new Dado();
            $funcionalidades[$indice]->titulo = $dados[$indice];
            $funcionalidades[$indice]->rota = $rotas[$indice];
        }
        return view('controle_versao.index', compact('branch_atual', 'funcionalidades'));
    }


    public function init()
    {
        $git = new GitSistemaRepository();
        $git->git_init();
        $branch_atual = $git->get_branch_current();
        $git->git_commit('inicializacao do repositorio');

        return view('controle_versao.index', compact('tipo', 'branch_atual'));
    }

    public function delete(Request $request)
    {
        $git = new GitSistemaRepository();
        $git->git_remove_branch($request->branch);
        return redirect()->route('index_create_delete');
    }

    public function create(Request $request)
    {
        $git = new GitSistemaRepository();
        $git->git_create_branch($request->branch);
        return redirect()->route('index_create_delete');
    }

    public function push(Request $request)
    {

    }

    public function pull(Request $request)
    {
    }

    private function merge(Request $request)
    {
        $git = new GitSistemaRepository();
        if ($git->is_exchanges()) {
            $git->git_commit('merge');
        }
        $git->git_merge_branch($request->branch);
        if ($git->is_exchanges()) {
            $git->git_commit('merge');
        }
        return redirect()->route('index_merge_checkout');
    }


    public function merge_checkout(Request $request)
    {
        if ($request->tipo==='merge'){
            return $this->merge($request);
        }
        return $this->checkout($request);
    }

    private function checkout(Request $request)
    {

//        $git->git_checkout_branch($request->branch);
        try {
            $git = new GitSistemaRepository();
            if ($git->is_exchanges()) {
                $git->git_commit('checkout');
            }
            $git_comando = new GitComando($git->get_path());
            $git_comando->checkout($request->branch);
        } catch (GitException $e) {
        }
        return redirect()->route('index_merge_checkout');
    }

    public function commit(Request $request)
    {
        $git = new GitSistemaRepository();
        $git->git_commit($request->mensagem);
        $branch_atual = $git->get_branch_current();
        return redirect()->route('index_commit_branch');
    }

    public function reset_files(){
        shell_exec('cd /home/vagrant/code/projeto21/database/banco && git checkout -f');
        return redirect()->route('index_reset_files');
    }

    public function index_reset_files(){
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        return view('controle_versao.teste',compact('branch_atual'));
    }

}
