<?php
/**
 * Created by PhpStorm.
 * User: jean
 * Date: 16/09/2018
 * Time: 02:46
 */

namespace App\Http\Fachadas;


use App\Http\Models\ModeloDeclarativo;
use App\http\Models\RepresentacaoDeclarativa;
use App\Http\Repositorys\ObjetoFluxoRepository;
use Illuminate\Http\Request;

class FachadaPadraoRecomendacaoBinario extends FachadaPadraoRecomendacao
{


    public function create(Request $request = null, $codmodelodeclarativo = null)
    {
        $modelo_declarativo = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        $objetos_fluxos = ObjetoFluxoRepository::listar();
        $tipo_operacao = 'binario';
        return view('controle_modelos_declarativos.controle_regras.create', compact('modelo_declarativo', 'objetos_fluxos', 'tipo_operacao'));
    }


}