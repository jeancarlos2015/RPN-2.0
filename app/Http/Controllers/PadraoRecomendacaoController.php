<?php

namespace App\Http\Controllers;

use App\Http\Models\ModeloDeclarativo;
use App\http\Models\ObjetoFluxo;
use App\http\Models\Regra;
use App\Http\Repositorys\ModeloDeclarativoRepository;
use App\Http\Repositorys\ObjetoFluxoRepository;
use App\Http\Repositorys\RegraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function create()
    {
    }

    public function create_recomendacao_conjunto($codmodelodeclarativo)
    {
        $modelo_declarativo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
        $objetos_fluxos = ObjetoFluxo::all();
        $tipo_operacao = 'conjunto';
        return view('controle_modelos_declarativos.controle_regras.create', compact('modelo_declarativo', 'objetos_fluxos', 'tipo_operacao'));
    }

    public function create_recomendacao_binario($codmodelodeclarativo)
    {
        $modelo_declarativo = ModeloDeclarativo::findOrFail($codmodelodeclarativo);
        $objetos_fluxos = ObjetoFluxo::all();
        $tipo_operacao = 'binario';
        return view('controle_modelos_declarativos.controle_regras.create', compact('modelo_declarativo', 'objetos_fluxos', 'tipo_operacao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    private function salvar($dado)
    {
        if (!empty($dado['id_objetos_fluxos'])){
            $id_objetos_fluxos = $dado['id_objetos_fluxos'];
            $codrepositorio = $dado['codrepositorio'];
            $codmodelodeclarativo = $dado['codmodelodeclarativo'];
            $codprojeto = $dado['codprojeto'];
            $codusaurio = $dado['codusuario'];
            $id_relacionamento = $dado['id_relacionamento'];
            $visivel_projeto = $dado['visivel_projeto'];
            $visivel_repositorio = $dado['visivel_repositorio'];
            $visivel_modelo_declarativo = $dado['visivel_modelo_declarativo'];
            for ($id_objeto = 0; $id_objeto < count($id_objetos_fluxos); $id_objeto++) {
                $objetofluxo = ObjetoFluxo::findOrFail($id_objetos_fluxos[$id_objeto]);
                $dado = [
                    'codobjetofluxo' => $id_objetos_fluxos[$id_objeto],
                    'codrepositorio' => $codrepositorio,
                    'codusuario' => $codusaurio,
                    'codprojeto' => $codprojeto,
                    'codmodelodeclarativo' => $codmodelodeclarativo,
                    'codoutraregra' => 0,
                    'nome' => 'Regra: '.Regra::PADROES[$id_relacionamento]. ' - '. $objetofluxo->nome,
                    'visivel_projeto' => $visivel_projeto,
                    'visivel_repositorio' => $visivel_repositorio,
                    'visivel_modelo_declarativo' => $visivel_modelo_declarativo,
                    'relacionamento' => $id_relacionamento
                ];

                $dado_objeto_fluxo = [
                    'codrepositorio' => $codrepositorio,
                    'codusuario' => $codusaurio,
                    'codprojeto' => $codprojeto,
                    'codmodelodeclarativo' => $codmodelodeclarativo,
                    'nome' => 'Regra: '.Regra::PADROES[$id_relacionamento]. ' - '. $objetofluxo->nome,
                    'descricao' => 'Regra',
                    'tipo' => 'Regra',
                    'visivel_projeto' => $visivel_projeto,
                    'visivel_repositorio' => $visivel_repositorio,
                    'visivel_modelo_declarativo' => $visivel_modelo_declarativo
                ];

                RegraRepository::inclui_se_existe($dado);
                ObjetoFluxoRepository::incluir_se_existe($dado_objeto_fluxo);
            }
        }

    }

    private function valida_request(Request $request)
    {
        $codmodelodeclarativo = $request->codmodelodeclarativo;
        if ($request->relacionamento === '0') {
            if (empty($request->sbOne) && empty($request->sbTwo)) {
                $dado['tipo'] = 'success';
                $dado['mensagem'] = "É necessário selecionar os valores";
                $this->create_log($dado);
                return redirect()->route('controle_padrao_create_conjunto', [
                    'codmodelodeclarativo' => $codmodelodeclarativo
                ]);
            }
        }else{
            if (empty($request->sbOne) || empty($request->sbTwo)) {
                $dado['tipo'] = 'success';
                $dado['mensagem'] = "É necessário selecionar os valores";
                $this->create_log($dado);
                return redirect()->route('controle_padrao_create_conjunto', [
                    'codmodelodeclarativo' => $codmodelodeclarativo
                ]);
            }
        }
    }


    public function store(Request $request)
    {

        $codmodelodeclarativo = $request->codmodelodeclarativo;
        $id_relacionamento = $request->relacionamento;
        $this->valida_request($request);
        $modelo = ModeloDeclarativoRepository::findOrFail($codmodelodeclarativo);
        $dado['codmodelodeclarativo'] = $request->codmodelodeclarativo;
        $dado['id_relacionamento'] = $request->relacionamento;
        $dado['codobjetofluxo'] = $modelo->codobjetofluxo;
        $dado['codusuario'] = Auth::user()->codusuario;
        $dado['codprojeto'] = $modelo->codprojeto;
        $dado['codrepositorio'] = $modelo->codrepositorio;
        $dado['visivel_projeto'] = $request->visivel_projeto;
        $dado['visivel_repositorio'] = $request->visivel_repositorio;
        $dado['visivel_modelo_declarativo'] = $request->visivel_modelo_declarativo;
        $dado['id_objetos_fluxos'] = $request->sbOne;
        $this->salvar($dado);
        $dado['id_objetos_fluxos'] = $request->sbTwo;
        $this->salvar($dado);
        $data['tipo'] = 'success';
        $this->create_log($data);
        return redirect()->route('controle_padrao_create_conjunto', [
            'codmodelodeclarativo' => $codmodelodeclarativo
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PadraoRecomendacao $padraoRecomendacao
     * @return \Illuminate\Http\Response
     */
    public function show($padraoRecomendacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PadraoRecomendacao $padraoRecomendacao
     * @return \Illuminate\Http\Response
     */
    public function edit($padraoRecomendacao)
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
    public function update(Request $request, $padraoRecomendacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PadraoRecomendacao $padraoRecomendacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($padraoRecomendacao)
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
