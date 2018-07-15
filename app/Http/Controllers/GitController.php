<?php

namespace App\Http\Controllers;

use App\Http\Models\Projeto;

use App\Http\Repositorys\GitRepository;
use App\Http\Repositorys\GitSistemaRepository;
use App\Http\Repositorys\LogRepository;
use App\Http\Util\Dado;
use Illuminate\Http\Request;

class GitController extends Controller
{
    private function funcionalidades(){
        return [
            'Merge & checkout',
            'Create & Delete',
            'Commit Branch',
            'Pull & Push Repository',
            'Initialization Repository'
        ];
    }

    private function rotas(){
        return [
            'index_merge_checkout',
            'index_create_delete',
            'index_commit_branch',
            'index_pull_push',
            'index_init'
        ];
    }

    public function index_merge_checkout(){
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.merge_checkout',compact('branch_atual','branchs'));
    }

    public function index_create_delete(){
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.create_delete',compact('branch_atual','branchs'));
    }
    public function index_commit_branch(){
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.commit',compact('branch_atual','branchs'));
    }

    public function index_pull_push(){
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $branchs = $git->get_branchs();
        return view('controle_versao.pull_push',compact('branch_atual','branchs'));
    }
    public function index()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        $funcionalidades = [];
        $rotas = self::rotas();
        $dados = self::funcionalidades();
        for ($indice = 0; $indice<5;$indice++){
            $funcionalidades[$indice] = new Dado();
            $funcionalidades[$indice]->titulo = $dados[$indice];
            $funcionalidades[$indice]->rota = $rotas[$indice];
        }
        return view('controle_versao.index',compact('branch_atual','funcionalidades'));
    }

    public function index_init(){
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        return view('controle_versao.init',compact('tipo','branch_atual'));
    }

    public function init()
    {
        $git = new GitSistemaRepository();
        $git->git_init();
        $branch_atual = $git->get_branch_current();
        $git->git_commit('inicializacao do repositorio');

        return view('controle_versao.index',compact('tipo','branch_atual'));
    }

    public function delete(Request $request)
    {

    }

    public function merge(Request $request)
    {
        //
    }
    public function checkout(Request $request)
    {
        //
    }
    public function commit(Request $request)
    {
        $git = new GitSistemaRepository();
        $git->git_commit($request->mensagem);
        $branch_atual = $git->get_branch_current();

    }

}
