<?php

namespace App\Http\Controllers;

use App\Http\Models\ModeloDeclarativo;
use App\http\Models\Regra;
use App\Http\Repositorys\RegraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($codmodelodeclarativo)
    {
        $regras = RegraRepository::listar();
        $tipo = 'regra';
        $titulos = Regra::titulos();
        $modelo_declarativo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
        $repositorio = $modelo_declarativo->repositorio;
        $projeto = $modelo_declarativo->projeto;
        return view('controle_regras.index', compact('regras', 'tipo', 'titulos','modelo_declarativo','repositorio','projeto'));
    }

    public function all()
    {
       $regras = RegraRepository::listar();
        $tipo = 'regra';
        $titulos = Regra::titulos();
        if (!empty(Auth::user()->repositorio)){
            $repositorio = Auth::user()->repositorio;
        }
        return view('controle_regras.all', compact('regras', 'tipo', 'titulos','repositorio'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\http\Models\Regra $regra
     * @return \Illuminate\Http\Response
     */
    public function show($codregra)
    {
        $regra = Regra::findOrFail($codregra);
        $projeto = $regra->projeto;
        $repositorio = $regra->repositorio;
        return view('controle_regras.show',compact('regra','projeto','repositorio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\http\Models\Regra $regra
     * @return \Illuminate\Http\Response
     */
    public function edit($codregra)
    {
        dd(null);
        $regra = RegraRepository::findOrFail($codregra);
        return view('controle_regras.edit',compact('regra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\http\Models\Regra $regra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regra $regra)
    {
        echo 'Pagina em construção';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\http\Models\Regra $regra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regra $regra)
    {
        echo 'Pagina em construção';
    }
}
