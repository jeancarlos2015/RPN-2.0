<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControleVersaoController extends Controller
{
    private $repositorio;

    public function area()
    {
        return view('controle_versao.area');
    }

    public function index()
    {
        return view('principal.index');
    }

    public function index_git_init(Request $request)
    {
        return view('controle_versao.index', compact('branch', 'change', 'diretorios'));
    }

    public function index_git_commit(Request $request)
    {
        return view('controle_versao.commit_branch');
    }

    public function index_create_branch(Request $request)
    {
        return view('controle_versao.create_branch', compact('branch', 'change'));
    }

    public function index_merge_branch(Request $request)
    {
        return view('controle_versao.merge_branch', compact('branch', 'change', 'branchs'));
    }

    public function index_clone_repository()
    {
        return view('controle_versao.clone_repository');
    }

    public function index_checkout_branch(Request $request)
    {

        return view('controle_versao.checkout_branch', compact('branch', 'changes', 'branchs'));
    }


    public function git_clone_repository(Request $request)
    {
        return view('controle_versao.clone_repository');
    }
}