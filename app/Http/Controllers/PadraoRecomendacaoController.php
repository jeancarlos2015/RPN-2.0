<?php

namespace App\Http\Controllers;

use App\Http\Models\ModeloDeclarativo;
use App\http\Models\ObjetoFluxo;
use App\PadraoRecomendacao;
use Illuminate\Http\Request;

class PadraoRecomendacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){}
    public function create_recomendacao_conjunto($codmodelodeclarativo)
    {
        $modelo_declarativo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
        $objetos_fluxos = ObjetoFluxo::all();
        $tipo_operacao = 'conjunto';
        return view('controle_modelos_declarativos.controle_regras.create', compact('modelo_declarativo','objetos_fluxos','tipo_operacao'));
    }

    public function create_recomendacao_binario($codmodelodeclarativo)
    {
        $modelo_declarativo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
        $objetos_fluxos = ObjetoFluxo::all();
        $tipo_operacao = 'binario';
        return view('controle_modelos_declarativos.controle_regras.create', compact('modelo_declarativo','objetos_fluxos','tipo_operacao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       echo 'PAGINA EM CONSTRUÇÃO';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PadraoRecomendacao $padraoRecomendacao
     * @return \Illuminate\Http\Response
     */
    public function show(PadraoRecomendacao $padraoRecomendacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PadraoRecomendacao $padraoRecomendacao
     * @return \Illuminate\Http\Response
     */
    public function edit(PadraoRecomendacao $padraoRecomendacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\PadraoRecomendacao $padraoRecomendacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PadraoRecomendacao $padraoRecomendacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PadraoRecomendacao $padraoRecomendacao
     * @return \Illuminate\Http\Response
     */
    public function destroy(PadraoRecomendacao $padraoRecomendacao)
    {
        //
    }

    public function padroes_recomendacoes($tipo)
    {

    }

    private function padrao_dependencia_circunstancial(Request $request)
    {

    }

    private function padrao_dependencia_estrita(Request $request)
    {

    }

    private function padrao_nao_coexistencia(Request $request)
    {

    }

    private function padrao_uniao(Request $request)
    {

    }


}
