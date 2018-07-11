<?php

namespace App\Http\Controllers;

use App\Http\Models\Projeto;
use App\Http\Repositories\VersionamentoRepository;
use Illuminate\Http\Request;

class VersionadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projetos = Projeto::all();
        $tipo = 'versionamento';
        return view('controle_versao.index',compact('projetos','tipo'));
    }


    public function create_branch(Request $request)
    {


     return view('controle_versao.index',compact('projetos','tipo'));
    }

    public function delete_branch(Request $request)
    {
        //
    }

    public function merge_branch(Request $request)
    {
        //
    }

    public function checkout_branch(Request $request)
    {
        //
    }
    public function commit_branch(Request $request)
    {
        //
    }

}
