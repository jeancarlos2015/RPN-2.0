<?php

namespace App\Http\Controllers;

use App\Http\Models\Projeto;

use App\Http\Repositorys\GitRepository;
use App\Http\Repositorys\GitSistemaRepository;
use Illuminate\Http\Request;

class GitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        return view('controle_versao.index',compact('tipo','branch_atual'));
    }

    public function index_init(){
        $git = new GitSistemaRepository();
        $branch_atual = $git->get_branch_current();
        return view('controle_versao.inicializacao_repositorio',compact('tipo','branch_atual'));
    }

    public function init()
    {
        $git = new GitSistemaRepository();
        $git->git_init();
        $branch_atual = $git->get_branch_current();
        $git->git_commit('inicializacao do repositorio');
        return view('controle_versao.inicializacao_repositorio',compact('tipo','branch_atual'));
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
