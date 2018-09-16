<?php

namespace App\Http\Controllers;

use App\Http\Models\RepresentacaoDeclarativa;
use App\http\Models\ObjetoFluxo;
use App\Http\Repositorys\RepresentacaoDeclarativaRepository;
use App\Http\Repositorys\ObjetoFluxoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObjetoFluxoController extends ControllerAbstrata
{


    public function controle_objeto_fluxo_index($codmodelodeclarativo)
    {
        $objetos_fluxos = ObjetoFluxoRepository::listar_objetos_fluxo($codmodelodeclarativo);
        $tipo = 'objetofluxo';
        $titulos = ObjetoFluxo::titulos_da_tabela();
        $modelo_declarativo = RepresentacaoDeclarativa::findOrFail($codmodelodeclarativo);
        return view('controle_modelos_declarativos.controle_objetos_fluxo.index', compact('objetos_fluxos', 'tipo', 'titulos','modelo_declarativo'));
    }


}
